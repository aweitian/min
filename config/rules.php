<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/16
 * Time: 14:52
 */

return array(
    "meizi" => 3, /*妹子的奖品ID*/
    "bonus" => 1, /*关注获得的次数*/
    "salt" => 'jlwx-shuanpan-wz', /*生成分享码的SALT*/
    "calc" => function ($share_count) {
        if ($share_count >= 18) return 4;
        if ($share_count >= 12) return 3;
        if ($share_count >= 7) return 2;
        if ($share_count >= 3) return 1;
        return 0;
    },
    "next" => function ($share_count) {
        if ($share_count < 3) return 3 - $share_count;
        if ($share_count < 7) return 7 - $share_count;
        if ($share_count < 12) return 12 - $share_count;
        if ($share_count < 18) return 18 - $share_count;
        return 0;
    }
);