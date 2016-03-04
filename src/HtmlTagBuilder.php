<?php namespace Dtkahl\HtmlTagBuilder;

class HtmlTagBuilder
{
  private $_type        = "";
  private $_attributes  = [];
  private $_text        = "";
  private $_options     = [];

  /**
   * HtmlTag constructor.
   * @param string $type
   * @param array $attributes
   * @param string $text
   * @param array $options
   */
  public function __construct(string $type, array $attributes = [], string $text = "", array $options = [])
  {
    $this->_type        = $type;
    $this->_attributes  = $attributes;
    $this->_text        = $text;
    $this->_options     = array_merge([
      'escape_text'  => true
    ], $options);
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
    $text       = $this->_options['escape_text'] ? htmlentities($this->_text) : $this->_text;
    $attributes = "";

    foreach ($this->_attributes as $name => $value) {
      $attributes .= sprintf(' %s="%s"', $name, $value);
    }

    if (in_array($this->_type, ['meta', 'img', 'input', 'br', 'hr'])) {
      return sprintf('<%s%s>', $this->_type, $attributes);
    } else {
      return sprintf('<%s%s>%s</%s>', $this->_type, $attributes, $text, $this->_type);
    }
  }

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function setAttribute($key, $value)
  {
    $this->_attributes[$key] = $value;
    return $this;
  }

  /**
   * @param $key
   * @param null $default
   * @return null
   */
  public function getAttribute($key, $default = null)
  {
    return array_key_exists($key, $this->_attributes) ? $this->_attributes[$key] : $default;
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

  /**
   * @param $key
   * @param $value
   * @return $this
   */
  public function setOption($key, $value)
  {
    $this->_options[$key] = $value;
    return $this;
  }

  /**
   * @param $key
   * @param null $default
   * @return null
   */
  public function getOption($key, $default = null)
  {
    return array_key_exists($key, $this->_options) ? $this->_options[$key] : $default;
  }

}
