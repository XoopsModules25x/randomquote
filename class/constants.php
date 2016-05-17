<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: RandomQuote
 *
 * Class (Interface) to define Random Quote module constant values. These
 * constants are used to make the code easier to read and to keep values in
 * central location if they need to be changed.  These should not normally need
 * to be modified. If they are to be modified it is recommended to change the
 * value(s) before module installation. Additionally the module may not work
 * correctly if trying to upgrade if these values have been changed locally.
 *
 * @category        Module
 * @package         randomquote
 * @author          XOOPS Module Development Team
 * @author          ZySpec <owners@zyspec.com>
 * @copyright       {@link http://xoops.org 2001-2016 XOOPS Project}
 * @license         {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @link            http://xoops.org XOOPS
 * @since           2.11
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

interface RandomquoteConstants
{
/**#@+
 * Constant definition
 */
    /**
     *  indicates a quote is inactive
     */
    const STATUS_OFFLINE = 0;
    /**
     *  indicates a quote is active
     */
    const STATUS_ONLINE = 1;
    /**
     *  indicates a quote is waiting approval
     */
    const STATUS_WAITING = 2;
    /**
     *  indicates default quote ID
     */
    const DEFAULT_ID = 0;
    /**
     * no delay XOOPS redirect delay (in seconds)
     */
    const REDIRECT_DELAY_NONE = 0;
    /**
     * short XOOPS redirect delay (in seconds)
     */
    const REDIRECT_DELAY_SHORT = 1;
    /**
     * medium XOOPS redirect delay (in seconds)
     */
    const REDIRECT_DELAY_MEDIUM = 3;
    /**
     * long XOOPS redirect delay (in seconds)
     */
    const REDIRECT_DELAY_LONG = 7;
    /**
     * confirm not ok to take action
     */
    const CONFIRM_NOT_OK = 0;
    /**
     * confirm ok to take action
     */
    const CONFIRM_OK = 1;
/**#@-*/
}
