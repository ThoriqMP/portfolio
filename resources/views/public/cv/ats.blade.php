<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->name }}</title>
    <style>
        @page {
            margin: 40px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4 {
            margin: 0 0 10px 0;
            color: #000;
        }
        h1 {
            font-size: 24pt;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 5px;
        }
        .contact-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 10pt;
        }
        .contact-info a {
            color: #333;
            text-decoration: none;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 14pt;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
            margin-bottom: 10px;
        }
        .item {
            margin-bottom: 15px;
        }
        .item-header {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }
        .item-title {
            display: table-cell;
            font-weight: bold;
            font-size: 12pt;
        }
        .item-date {
            display: table-cell;
            text-align: right;
            font-style: italic;
            font-size: 10pt;
            width: 30%;
        }
        .item-subtitle {
            font-style: italic;
            font-size: 11pt;
            margin-bottom: 5px;
        }
        .item-desc {
            margin: 0;
            text-align: justify;
        }
        .skills-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .skills-list li {
            display: inline-block;
            margin-right: 15px;
            margin-bottom: 5px;
        }
        p {
            margin: 0 0 5px 0;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <h1>{{ $user->name }}</h1>
    <div class="contact-info">
        @if($user->email)
            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
        @endif
        
        @foreach($user->socialLinks as $social)
            | <a href="{{ $social->url }}">{{ $social->platform }}</a>
        @endforeach
    </div>

    <!-- SUMMARY / ABOUT -->
    @if($user->about)
    <div class="section">
        <h2 class="section-title">Professional Summary</h2>
        <p class="item-desc">{!! nl2br(e($user->about)) !!}</p>
    </div>
    @endif

    <!-- EXPERIENCE -->
    @if($user->experiences && $user->experiences->count() > 0)
    <div class="section">
        <h2 class="section-title">Experience</h2>
        @foreach($user->experiences as $exp)
            <div class="item">
                <div class="item-header">
                    <div class="item-title">{{ $exp->title }}</div>
                    <div class="item-date">
                        {{ \Carbon\Carbon::parse($exp->start_date)->format('M Y') }} - 
                        {{ $exp->is_current ? 'Present' : \Carbon\Carbon::parse($exp->end_date)->format('M Y') }}
                    </div>
                </div>
                <div class="item-subtitle">{{ $exp->company }}</div>
                @if($exp->description)
                    <div class="item-desc">{!! nl2br(e($exp->description)) !!}</div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- EDUCATION -->
    @if($user->educations && $user->educations->count() > 0)
    <div class="section">
        <h2 class="section-title">Education</h2>
        @foreach($user->educations as $edu)
            <div class="item">
                <div class="item-header">
                    <div class="item-title">{{ $edu->degree }}</div>
                    <div class="item-date">
                        {{ $edu->start_year }} - {{ $edu->end_year ?? 'Present' }}
                    </div>
                </div>
                <div class="item-subtitle">{{ $edu->institution }}</div>
                @if($edu->description)
                    <div class="item-desc">{!! nl2br(e($edu->description)) !!}</div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- PROJECTS -->
    @if($user->projects && $user->projects->count() > 0)
    <div class="section">
        <h2 class="section-title">Projects</h2>
        @foreach($user->projects as $proj)
            <div class="item">
                <div class="item-header">
                    <div class="item-title">{{ $proj->title }}</div>
                    @if($proj->link)
                        <div class="item-date"><a href="{{ $proj->link }}">{{ parse_url($proj->link, PHP_URL_HOST) }}</a></div>
                    @endif
                </div>
                @if($proj->description)
                    <div class="item-desc">{!! nl2br(e($proj->description)) !!}</div>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- SKILLS / BADGES -->
    @if($user->badges && $user->badges->count() > 0)
    <div class="section">
        <h2 class="section-title">Skills & Technologies</h2>
        <ul class="skills-list">
            @foreach($user->badges as $badge)
                <li>• {{ $badge->name }}</li>
            @endforeach
        </ul>
    </div>
    @endif

</body>
</html>
