<?php

namespace Komptip\PhpTiktokSdk;

enum UserField: string
{
    case OpenID = 'open_id';
    case UnionID = 'union_id';
    case AvatarURL = 'avatar_url';
    case AvatarURL100 = 'avatar_url_100';
    case AvatarLargeURL = 'avatar_larger_url';
    case DisplayName = 'display_name';
    case BioDescription = 'bio_description';
    case ProfileDeepLink = 'profile_deep_link';
    case IsVerified = 'is_verified';
    case UserName = 'user_name';
    case FollowerCount = 'follower_count';
    case FollowingCount = 'following_count';
    case LikeCount = 'like_count';
    case VideoCount = 'video_count';
}