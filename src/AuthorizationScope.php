<?php

namespace Komptip\PhpTiktokSdk;

enum AuthorizationScope: string
{
    case UserInfoBasic = 'user.info.basic';
    case UserInfoProfile = 'user.info.profile';
    case UserInfoStats = 'user.info.stats';

    case VideoList = 'video.list';
}