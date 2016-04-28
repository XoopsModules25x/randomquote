<?php

/**
 * Module: RandomQuote
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * PHP version 5
 *
 * @category        Module
 * @package         Randomquote
 * @author          XOOPS Development Team, Mamba
 * @copyright       2001-2016 XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @link            http://xoops.org/
 * @since           2.0.0
 */
class RandomQuoteUtilities
{

    /***************Blocks**************
     * @param $cats
     * @return string
     */
    public static function randomquote_block_addCatSelect($cats)
    {
        $cat_sql = '';
        if (is_array($cats)) {
            $cat_sql = '(' . current($cats);
            array_shift($cats);
            foreach ($cats as $cat) {
                $cat_sql .= ',' . $cat;
            }
            $cat_sql .= ')';
        }

        return $cat_sql;
    }

    /**
     * @param               $global
     * @param               $key
     * @param  string       $default
     * @param  string       $type
     * @return mixed|string
     */
    public static function cleanVarsRandomquote(&$global, $key, $default = '', $type = 'int')
    {
        switch ($type) {
            case 'string':
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_MAGIC_QUOTES) : $default;
                break;
            case 'int':
            default:
                $ret = isset($global[$key]) ? filter_var($global[$key], FILTER_SANITIZE_NUMBER_INT) : $default;
                break;
        }
        if ($ret === false) {
            return $default;
        }

        return $ret;
    }

    /**
     * @param $content
     */
    public static function setMetaKeywordsRandomquote($content)
    {
        global $xoopsTpl, $xoTheme;
        $myts    = MyTextSanitizer::getInstance();
        $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
        if (isset($xoTheme) && is_object($xoTheme)) {
            $xoTheme->addMeta('meta', 'keywords', strip_tags($content));
        } else { // Compatibility for old Xoops versions
            $xoopsTpl->assign('xoops_meta_keywords', strip_tags($content));
        }
    }

    /**
     * @param $content
     */
    public static function setMetaDescriptionRandomquote($content)
    {
        global $xoopsTpl, $xoTheme;
        $myts    = MyTextSanitizer::getInstance();
        $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
        if (isset($xoTheme) && is_object($xoTheme)) {
            $xoTheme->addMeta('meta', 'description', strip_tags($content));
        } else { // Compatibility for old Xoops versions
            $xoopsTpl->assign('xoops_meta_description', strip_tags($content));
        }
    }
}
