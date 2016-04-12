<?php

namespace Phim\Text\Font;

interface StyleInterface
{

    public function getLineHeight();
    public function setLineHeight($lineHeight);
    public function getLetterSpacing();
    public function setLetterSpacing($letterSpacing);

    public function isMonoSpaced();
    public function monoSpace();
    public function isItalic();
    public function getItalic();
    public function getStraight();
    public function isBold();
    public function getBold();
    public function getRegular();
}