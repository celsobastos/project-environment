<?php

/**
 * Configuration for webgrind
 * @author Jacob Oettinger
 * @author Joakim Nygård
 */
class Webgrind_Config extends Webgrind_MasterConfig {
    /**
     * Automatically check if a newer version of webgrind is available for download
     */
    static $checkVersion = true;
    static $hideWebgrindProfiles = true;

    /**
     * Writable dir for information storage.
     * If empty, will use system tmp folder or xdebug tmp
     */
    static $storageDir = '';
    static $profilerDir = '/home/celso/projeto-docker-php/logs/php/performance';

    /**
     * Suffix for preprocessed files
     */
    static $preprocessedSuffix = '.webgrind';

    /**
     * Image type of graph to output
     * Can be png or svg
     */
    static $graphImageType = 'svg';

    static $defaultTimezone = 'Europe/Copenhagen';
    static $dateFormat = 'Y-m-d H:i:s';
    static $defaultCostformat = 'percent'; // 'percent', 'usec' or 'msec'
    static $defaultFunctionPercentage = 90;
    static $defaultHideInternalFunctions = false;

    /**
     * Path to python executable
     */
    static $pythonExecutable = '/usr/bin/python3';

    /**
     * Path to graphviz dot executable
     */
    static $dotExecutable = '/usr/bin/dot';

    /**
     * sprintf compatible format for generating links to source files.
     * %1$s will be replaced by the full path name of the file
     * %2$d will be replaced by the linenumber
     */
    static $fileUrlFormat = 'index.php?op=fileviewer&file=%1$s#line%2$d'; // Built in fileviewer
    //static $fileUrlFormat = 'txmt://open/?url=file://%1$s&line=%2$d'; // Textmate
    //static $fileUrlFormat = 'vscode://file/%1$s:%2$d'; // VSCode
    //static $fileUrlFormat = 'file://%1$s'; // ?

    /**
     * Enable viewing of server files.
     *
     * Add whatever logic necessary to determine whether a visitor can
     * access a particular file. Access is granted if this function returns
     * a path to a readable file.
     */
    static function exposeServerFile($file) {
        // Grant access to all files remapped under the `/host` directory.
        //$prefix = '/host/';                                    /** DOCKER:ENABLE **/
        //$file = realpath($prefix . $file);                     /** DOCKER:ENABLE **/
        //return strncmp($prefix, $file, strlen($prefix)) === 0  /** DOCKER:ENABLE **/
        //    ? $file                                            /** DOCKER:ENABLE **/
        //    : false;                                           /** DOCKER:ENABLE **/

        return false; // Deny all access.

        //return $file; // Grant access to all files on server.

        // Limit to web root.
        //return isset($_SERVER['DOCUMENT_ROOT'])
        //    && ($file = realpath($file))
        //    && preg_match('#^' . preg_quote($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR, '#') . '#', $file)
        //    ? $file : false;
    }

    /**
     * format of the trace drop down list
     * default is: invokeurl (tracefile_name) [tracefile_size]
     * the following options will be replaced:
     *   %i - invoked url
     *   %f - trace file name
     *   %s - size of trace file
     *   %m - modified time of file name (in dateFormat specified above)
     */
    static $traceFileListFormat = '%i (%f) [%s]';

    /**
     * Proxy functions are stepped over transparently. Functions listed here
     * MUST make exactly one (though not necessarily the same one) function
     * call per execution.
     */
    static $proxyFunctions = array( // resolve dynamic function calls in-place
        'php::call_user_func',
        'php::call_user_func_array',
    );
    //static $proxyFunctions = array(); // do not skip any functions

    /**
     * Specify which fields display, and the order to display them. Uncomment
     * entries to enable, move entries to change order.
     */
    static $tableFields = array(
        'Invocation Count',
        'Total Self Cost',
        //'Average Self Cost',
        'Total Inclusive Cost',
        //'Average Inclusive Cost',
    );

    #########################
    # BELOW NOT FOR EDITING #
    #########################

    /**
     * Regex that matches the trace files generated by xdebug
     */
    static function xdebugOutputFormat() {
        $outputName = ini_get('xdebug.profiler_output_name');
        if ($outputName=='') // Ini value not defined
            $outputName = '/^xdebug.performance\.out\..?$/';
        else
            $outputName = '/^'.preg_replace('/(%[^%])+/', '.+', $outputName).'$/';
        return $outputName;
    }

    /**
     * Directory to search for trace files
     *
     * @return string xdebug output directory
     */
    static function xdebugOutputDir() {
        // grab the Xdebug 3 output dir value
        $dir = ini_get('xdebug.output_dir');

        // if it's empty, check the Xdebug 2 value
        if (empty($dir))
            $dir = ini_get('xdebug.profiler_output_dir');

        // If it's still empty, fall back to webgrind config
        if (empty($dir))
            $dir = Webgrind_Config::$profilerDir;

        return realpath($dir).'/';
    }

    /**
     * Writable dir for information storage
     */
    static function storageDir() {
        if (!empty(Webgrind_Config::$storageDir))
            return realpath(Webgrind_Config::$storageDir).'/';

        if (!function_exists('sys_get_temp_dir') || !is_writable(sys_get_temp_dir())) {
            // use xdebug setting
            return Webgrind_Config::xdebugOutputDir();
        }
        return realpath(sys_get_temp_dir()).'/';
    }

    /**
     * Binary version of the preprocessor (for faster preprocessing)
     *
     * If the proper tools are installed and the bin dir is writeable for php,
     * automatically compile it (when necessary).
     * Automatic compilation disabled if `bin/make-failed` exists.
     * Run `make` in the webgrind root directory to manually compile.
     */
    static function getBinaryPreprocessor() {
        $localBin = __DIR__.'/bin/';
        $makeFailed = $localBin.'make-failed';
        if (PHP_OS == 'WINNT') {
            $binary = $localBin.'preprocessor.exe';
        } else {
            $binary = $localBin.'preprocessor';
        }

        if (!file_exists($binary) && is_writable($localBin) && !file_exists($makeFailed)) {
            if (PHP_OS == 'WINNT') {
                $success = static::compileBinaryPreprocessorWindows();
            } else {
                $success = static::compileBinaryPreprocessor();
            }
            if (!$success || !file_exists($binary)) {
                touch($makeFailed);
            }
        }

        return $binary;
    }

    static function compileBinaryPreprocessor() {
        $make = '/usr/bin/make';
        if (is_executable($make)) {
            $cwd = getcwd();
            chdir(__DIR__);
            exec($make, $output, $retval);
            chdir($cwd);
            return $retval == 0;
        }
        return false;
    }

    static function compileBinaryPreprocessorWindows() {
        if (getenv('VSAPPIDDIR')) {
            $cwd = getcwd();
            chdir(__DIR__);
            exec('call "%VSAPPIDDIR%\..\Tools\vsdevcmd\ext\vcvars.bat" && nmake -f nmakefile', $output, $retval);
            chdir($cwd);
            return $retval == 0;
        } elseif (getenv('VS140COMNTOOLS')) {
            $cwd = getcwd();
            chdir(__DIR__);
            exec('call "%VS140COMNTOOLS%\vsvars32.bat" && nmake -f nmakefile', $output, $retval);
            chdir($cwd);
            return $retval == 0;
        }
        return false;
    }
}
