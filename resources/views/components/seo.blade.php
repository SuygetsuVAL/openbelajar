@php
$pageTitle = $title ?? config('app.name');
$pageDescription = $description ?? 'Portfolio OS - Managing digital experiences';
$pageImage = $image ?? asset('images/default-og.jpg');
$pageUrl = url()->current();
@endphp

<meta name="description" content="{{ $pageDescription }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $pageUrl }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDescription }}">
<meta property="og:image" content="{{ $pageImage }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $pageUrl }}">
<meta property="twitter:title" content="{{ $pageTitle }}">
<meta property="twitter:description" content="{{ $pageDescription }}">
<meta property="twitter:image" content="{{ $pageImage }}">
