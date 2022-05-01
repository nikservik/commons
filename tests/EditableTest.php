<?php

namespace Nikservik\Commons\Tests;

use Nikservik\Commons\Editable;

class EditableTest extends TestCase
{
    public function test_strips_tags()
    {
        $content = Editable::stripTags('<div>test</div><span>4</span>');

        $this->assertEquals('<div>test</div>4', $content);
    }

    public function test_strips_tag_attributes()
    {
        $content = Editable::stripTagAttributes('<div class="12">test</div><p style="3">4</p>');

        $this->assertEquals('<div>test</div><p>4</p>', $content);
    }

    public function test_replaces_div_by_p()
    {
        $content = Editable::replaceDivByP('<div>test</div><p>4</p>');

        $this->assertEquals('<p>test</p><p>4</p>', $content);
    }

    public function test_trims_spaces()
    {
        $content = Editable::trim('   <div>test</div><p>4</p>    ');

        $this->assertEquals('<div>test</div><p>4</p>', $content);
    }

    public function test_trims_leading_empty_p()
    {
        $content = Editable::trim('<p></p><p>test</p><p>4</p>');

        $this->assertEquals('<p>test</p><p>4</p>', $content);
    }

    public function test_envelopes_with_p()
    {
        $content = Editable::envelopeWithP('test<br>ttt<p>4</p>');

        $this->assertEquals('<p>test<br>ttt</p><p>4</p>', $content);
    }

    public function test_envelopes_with_p_empty()
    {
        $content = Editable::envelopeWithP('');

        $this->assertEquals('<p></p>', $content);
    }

    public function test_envelopes_with_p_full()
    {
        $content = Editable::envelopeWithP('test<br>ttt');

        $this->assertEquals('<p>test<br>ttt</p>', $content);
    }

    public function test_envelopes_with_p_none()
    {
        $content = Editable::envelopeWithP('<p>test<br>ttt</p><p>4</p>');

        $this->assertEquals('<p>test<br>ttt</p><p>4</p>', $content);
    }

    public function test_trims_last_empty_p()
    {
        $content = Editable::trimLastEmptyPs('<p>test</p><p>4</p><p></p>');

        $this->assertEquals('<p>test</p><p>4</p>', $content);
    }

    public function test_trims_last_empty_p_with_br()
    {
        $content = Editable::trimLastEmptyPs('<p>test</p><p>4</p><p><br></p>');

        $this->assertEquals('<p>test</p><p>4</p>', $content);
    }

    public function test_trims_last_empty_ps()
    {
        $content = Editable::trimLastEmptyPs('<p>test</p><p>4</p><p></p><p></p><p></p>');

        $this->assertEquals('<p>test</p><p>4</p>', $content);
    }

    public function test_trims_last_empty_ps_with_br()
    {
        $content = Editable::trimLastEmptyPs('<p>test</p><p>4</p><p><br></p><p><br></p><p><br></p>');

        $this->assertEquals('<p>test</p><p>4</p>', $content);
    }

    public function test_replaces_multiple_empty_ps()
    {
        $content = Editable::replaceMultipleP('<p>test</p><p></p><p></p><p></p><p>4</p>');

        $this->assertEquals('<p>test</p><p></p><p>4</p>', $content);
    }

    public function test_replaces_multiple_empty_ps_with_br()
    {
        $content = Editable::replaceMultipleP('<p>test</p><p><br></p><p><br></p><p>4</p>');

        $this->assertEquals('<p>test</p><p><br></p><p>4</p>', $content);
    }
}
