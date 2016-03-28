<?php namespace Dtkahl\HtmlTagBuilder;

use Dtkahl\ArrayTools\Map;

class HtmlTagBuilder
{
  private $_type        = "";
  private $_text        = "";
  public $attributes    = [];
  public $options       = [];

  /**
   * HtmlTag constructor.
   * @param string $type
   * @param array $attributes
   * @param string $text
   * @param array $options
   */
  public function __construct($type, array $attributes = [], $text = "", array $options = [])
  {
    $this->_type       = (string) $type;
    $this->_text       = (string) $text;
    $this->attributes  = new Map($attributes);
    $this->options     = new Map(array_merge([
      'escape_text'  => true
    ], $options));
  }

  /**
   * @return string
   */
  public function __toString()
  {
    return $this->render();
  }

  /**
   * @return string
   */
  public function render()
  {
    $text       = $this->options->has('escape_text') ? htmlentities($this->_text) : $this->_text;
    $attributes = "";

    foreach ($this->attributes->toArray() as $name => $value) {
      $attributes .= sprintf(' %s="%s"', $name, $value);
    }

    if (in_array($this->_type, ['meta', 'img', 'input', 'br', 'hr', 'link'])) {
      return sprintf('<%s%s>', $this->_type, $attributes);
    } else {
      return sprintf('<%s%s>%s</%s>', $this->_type, $attributes, $text, $this->_type);
    }
  }

  /**
   * @param $text
   * @return $this
   */
  public function setText($text)
  {
    $this->_text = $text;
    return $this;
  }

  /**
   * @return string
   */
  public function getText()
  {
    return $this->_text;
  }

}
