<?php namespace Dtkahl\HtmlTagBuilder;

class HtmlTagBuilderTest extends \PHPUnit_Framework_TestCase {

  public function testConstructor()
  {
    $tag = new HtmlTagBuilder('div', ['class' => 'foo'], 'bar');
    $this->assertEquals('<div class="foo">bar</div>', $tag->render());
  }

  public function testBuild()
  {
    $tag = new HtmlTagBuilder('div');
    $tag->attributes->set('class', 'foo');
    $tag->setText('bar');
    $this->assertEquals('<div class="foo">bar</div>', $tag->render());
  }

}