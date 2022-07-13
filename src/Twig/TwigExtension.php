<?php

namespace App\Twig;

use App\Helper\DateTimeHelper;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use Mexitek\PHPColors\Color;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class TwigExtension extends AbstractExtension
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('render_date', array($this, 'renderDate')),
            new TwigFunction('convert_slug_to_string', array($this, 'convertSlugToString')),
            new TwigFunction('render_diff_day', array($this, 'renderDiffDay')),
            new TwigFunction('render_light_or_dark_text_color', array($this, 'renderLightOrDarkTextColor'))
        );
    }

    /**
     * @param DateTimeInterface|null $date
     * @param null|string $displayEmpty
     * @return string
     */
    public function renderDate(?DateTimeInterface $date, ?string $displayEmpty = null): string
    {
        if ($date === null) {
            if ($displayEmpty !== null) {
                return $displayEmpty;
            }
            return '';
        }
        return DateTimeHelper::formatDate($date);
    }

    /**
     * @param DateTimeInterface $date
     * @return string
     */
    public function renderDiffDay(DateTimeInterface $date): string
    {
        $today = new DateTimeImmutable();
        $diff = $date->diff($today)->days;
        switch ($diff) {
            case 0:
                return $this->translator->trans('global.today');
                break;
            case 1:
                return $this->translator->trans('global.yesterday');
                break;
            case $diff > 1 && $diff <= 15:
                return $this->translator->trans('global.days_ago', array(
                    '%count_days%' => $diff
                ));
                break;
            case $diff > 15:
                return $this->renderDate($date, '-');
                break;
            default:
                return '-';
        }
    }

    /**
     * @param string $string
     * @return string
     */
    public function convertSlugToString(string $string): string
    {
        return implode(' ', explode('-', $string));
    }

    /**
     * @throws Exception
     */
    public function renderLightOrDarkTextColor(string $color): string
    {
        $colorClass = new Color($color);
        return $colorClass->isDark() ? '#ffffff' : '#000000';
    }
}
