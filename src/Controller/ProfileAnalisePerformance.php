<?php

namespace Celso\Environment\Controller;

/**
 * Undocumented class.
 */
class ProfileAnalisePerformance implements \IteratorAggregate {

  /**
   * Undocumented variable.
   *
   * @var array
   */
  private array $flatArray;

  /**
   * Undocumented variable.
   *
   * @var array
   */
  private array $new;

  /**
   * This function asd fasdfasdf .
   *
   * @param array $originalArray
   *   Fasdfasdf asdf.
   */
  public function __construct(array $originalArray) {
    $this->flatArray['use_merge'] = [];
    $this->flatArray['new_merge'] = [];
    $this->flatArray['use_push'] = [];
    $this->flatArray['use_nothink'] = [];
    $this->flatArray['use_splice'] = [];

    $this->flattenArray($originalArray);
    // $test = 900000;
    // $this->createArray($originalArray);
    // $this->createArrayFixed($originalArray);
  }

  private teste

  /**
   * Undocumented function.
   *
   * @param array $originalArray
   *   Test all original.
   */
  private function flattenArray(array $originalArray) {
    $this->useMerge($originalArray);
    $this->useNewMerge($originalArray);
    $this->usePush($originalArray);
    $this->useNothink($originalArray);
    $this->useSplice($originalArray);
  }

  /**
   * Undocumented function.
   *
   * @param array $originalArray
   *   Dfds asd fasd.
   */
  public function useMerge(array $originalArray): void {
    foreach ($originalArray as $item) {
      $this->flatArray['use_merge'] = array_merge($this->flatArray['use_merge'], $item);
    }
  }

  /**
   * Undocumented function.
   *
   * @param array $originalArray
   *   Sfdsgfgsd asd a.
   */
  public function useNewMerge(array $originalArray) {
    $this->flatArray['new_merge'] = array_merge(...$originalArray);
  }

  /**
   * Undocumented function.
   *
   * @param array $originalArray
   *   Edsfsda  asdf .
   */
  public function usePush(array $originalArray) {
    foreach ($originalArray as $item) {
      array_push($this->flatArray['use_push'], $item[0], $item[1]);
    }
  }

  /**
   * Undocumented function.
   *
   * @param array $originalArray
   *   Adfsadfa  fafsd.
   */
  public function useNothink(array $originalArray) {
    foreach ($originalArray as $item) {
      $this->flatArray['use_nothink'][] = $item[0];
      $this->flatArray['use_nothink'][] = $item[1];
    }
  }

  /**
   * Undocumented function.
   *
   * @param array $originalArray
   *   Fdfsdafasf  d.
   */
  public function useSplice(array $originalArray) {
    foreach ($originalArray as $item) {
      array_splice($this->flatArray['use_splice'], count($this->flatArray['use_splice']), 0, $item);
    }
  }

  /**
   * Undocumented function.
   *
   * @return \Traversable
   *   Esfdsf adfasdf asfd as.
   */
  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->flatArray);
  }

  /**
   * Undocumented function.
   *
   * @param int $num
   *   Fadfas asdfasfd.
   */
  public function createArrayFixed(int $num) {
    $new = new \SplFixedArray($num);
    for ($i = 0; $i <= $new->getSize() - 1; ++$i) {
      $new[$i] = $i;
    }
    $this->new = $new->toArray();
  }

  /**
   * Undocumented function sdfa sdfasd.
   *
   * @param array $array
   *   Dssdfasdfads.
   */
  public function createArray(array $array) {
    for ($i = 0; $i < count($array); $i++) {
      $this->new[$i] = $i;
    }
  }

  /**
   * Undocumented function.
   */
  public function getResult() {
    return $this->flatArray;
  }

  /**
   * Undocumented function.
   *
   * @return string
   *   Acfsafd as fasd.
   */
  public function __toString() {
    $test = '';
    foreach ($this->new as $value) {
      $test .= $value . ', ';
    }

    return $test;
  }

  /**
   * Undocumented function.
   *
   * @return string
   *   Fsgsfsdf sdfg sd.
   */
  public function saveData() {
    return 'Test';
  }

}
