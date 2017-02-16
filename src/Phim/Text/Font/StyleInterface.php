<?php

namespace Phim\Text\Font;

interface StyleInterface
{

    public function getLineHeight();
    public function setLineHeight($lineHeight);
    public function getLetterSpacing();
    public function setLetterSpacing($letterSpacing);
}