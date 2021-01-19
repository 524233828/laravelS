<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/2/4
 * Time: 23:31
 */

namespace App\Services\WechatOfficial\Constant;


use App\Models\WechatReceivedEventReply;
use App\Models\WechatReceivedReply;
use App\Models\WechatReplyText;
use App\Services\WechatOfficial\Replier\TextReplier;

/**
 * 用户消息类型定义
 * Class UserEventType
 * @package App\Services\WechatOfficial\Constant
 */
class UserEventType
{
    /** @var int 文本消息 */
    const TEXT = 1;
    /** @var int 图片消息 */
    const IMAGE = 2;
    /** @var int 语音消息 */
    const VOICE = 3;
    /** @var int 视频消息 */
    const VIDEO = 4;
    /** @var int 短视频消息 */
    const SHORT_VIDEO = 5;
    /** @var int 地理位置上报消息 */
    const LOCATION = 6;
    /** @var int 链接消息 */
    const LINK = 7;
    /** @var int 文本消息 */
    const EVENT = 8;

    /** @var array $alias 微信事件名称 */
    public static $alias = [
        self::TEXT => "text",
        self::EVENT => "event",
    ];

    public static $replier_model = [
        self::TEXT => WechatReplyText::class,
    ];

    public static $replier = [
        self::TEXT => TextReplier::class,
    ];

    public static $connector_model = [
        self::TEXT => WechatReceivedReply::class,
        self::EVENT => WechatReceivedEventReply::class,
    ];
}