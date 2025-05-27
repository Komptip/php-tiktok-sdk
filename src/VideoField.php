<?php

namespace Komptip\PhpTiktokSdk;

enum VideoField: string
{
    case ID = 'id';
    case CreateTime = 'create_time';
    case CoverImageURL = 'cover_image_url';
    case ShareURL = 'share_url';
    case VideoDescription = 'video_description';
    case Duration = 'duration';
    case Height = 'height';
    case Width = 'width';
    case Title = 'title';
    case EmbedHTML = 'embed_html';
    case EmbedLink = 'embed_link';
    case LikeCount = 'like_count';
    case CommentCount = 'comment_count';
    case ShareCount = 'share_count';
    case ViewCount = 'view_count';
}