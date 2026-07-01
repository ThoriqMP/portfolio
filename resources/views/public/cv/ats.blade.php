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
            font-size: 10.5pt;
            line-height: 1.5;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4 {
            margin: 0;
            color: #000000;
        }
        h1 {
            font-size: 22pt;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 12pt;
            color: #555555;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-cell-left {
            width: 110px;
            vertical-align: top;
            padding-right: 15px;
        }
        .header-cell-right {
            vertical-align: middle;
        }
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-cover: cover;
            border: 2px solid #000000;
        }
        .contact-info {
            font-size: 9.5pt;
            color: #444444;
            line-height: 1.6;
        }
        .contact-info a {
            color: #0056b3;
            text-decoration: none;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 13pt;
            text-transform: uppercase;
            font-weight: bold;
            border-bottom: 2px solid #000000;
            padding-bottom: 2px;
            margin-bottom: 10px;
            color: #000000;
            letter-spacing: 0.5px;
        }
        .item {
            margin-bottom: 12px;
        }
        .item-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }
        .item-title {
            font-weight: bold;
            font-size: 11pt;
            color: #111111;
            text-align: left;
        }
        .item-date {
            text-align: right;
            font-style: italic;
            font-size: 9.5pt;
            color: #555555;
            width: 150px;
        }
        .item-subtitle-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }
        .item-subtitle {
            font-style: italic;
            font-size: 10pt;
            color: #444444;
            text-align: left;
        }
        .item-desc {
            margin: 0;
            text-align: justify;
            font-size: 10pt;
            color: #333333;
        }
        .skills-container {
            font-size: 10pt;
        }
        .skills-group {
            margin-bottom: 5px;
        }
        .skills-label {
            font-weight: bold;
            display: inline-block;
        }
        p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- HEADER SECTION -->
    <table class="header-table">
        <tr>
            @if($user->avatar_path && file_exists(storage_path('app/public/' . $user->avatar_path)))
                <td class="header-cell-left">
                    <img class="avatar" src="{{ storage_path('app/public/' . $user->avatar_path) }}" alt="Profile Picture">
                </td>
            @endif
            <td class="header-cell-right">
                <h1>{{ $user->name }}</h1>
                @if($user->title)
                    <div class="subtitle">{{ $user->title }}</div>
                @endif
                <div class="contact-info">
                    @php
                        $emailLink = $user->socialLinks->where('icon', 'email')->first();
                        $whatsappLink = $user->socialLinks->where('icon', 'whatsapp')->first();
                        $githubLink = $user->socialLinks->where('icon', 'github')->first();
                        $linkedinLink = $user->socialLinks->where('icon', 'linkedin')->first();
                        
                        $contactDetails = [];
                        
                        if ($emailLink) {
                            $email = str_replace('mailto:', '', $emailLink->link);
                            $contactDetails[] = '<a href="' . $emailLink->link . '">' . $email . '</a>';
                        }
                        
                        if ($whatsappLink) {
                            $phone = $whatsappLink->name;
                            $contactDetails[] = '<a href="' . $whatsappLink->link . '">' . $phone . '</a>';
                        }
                        
                        if ($linkedinLink) {
                            $contactDetails[] = '<a href="' . $linkedinLink->link . '">LinkedIn</a>';
                        }
                        
                        if ($githubLink) {
                            $contactDetails[] = '<a href="' . $githubLink->link . '">GitHub</a>';
                        }
                    @endphp
                    {!! implode(' &bull; ', $contactDetails) !!}
                </div>
            </td>
        </tr>
    </table>

    <!-- PROFESSIONAL SUMMARY -->
    @if($user->bio)
    <div class="section">
        <h2 class="section-title">Professional Summary</h2>
        <p class="item-desc">{!! nl2br(e($user->bio)) !!}</p>
    </div>
    @endif

    <!-- WORK EXPERIENCE -->
    @if($user->experiences && $user->experiences->count() > 0)
    <div class="section">
        <h2 class="section-title">Professional Experience</h2>
        @foreach($user->experiences as $exp)
            <div class="item">
                <table class="item-header-table">
                    <tr>
                        <td class="item-title">{{ $exp->position }}</td>
                        <td class="item-date">
                            {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }} &ndash; 
                            {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Present' }}
                        </td>
                    </tr>
                </table>
                <table class="item-subtitle-table">
                    <tr>
                        <td class="item-subtitle">{{ $exp->company_name }}</td>
                    </tr>
                </table>
                @if($exp->description)
                    <div class="item-desc">
                        @php
                            $points = json_decode($exp->description, true);
                        @endphp
                        @if(is_array($points))
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($points as $point)
                                    @if(trim($point) !== '')
                                        <li>{{ $point }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            {!! nl2br(e($exp->description)) !!}
                        @endif
                    </div>
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
                <table class="item-header-table">
                    <tr>
                        <td class="item-title">{{ $edu->degree }}</td>
                        <td class="item-date">
                            {{ $edu->start_year }} &ndash; {{ $edu->end_year ?? 'Present' }}
                        </td>
                    </tr>
                </table>
                <table class="item-subtitle-table">
                    <tr>
                        <td class="item-subtitle">{{ $edu->institution_name }}</td>
                    </tr>
                </table>
                @if($edu->description)
                    <div class="item-desc">
                        @php
                            $eduPoints = json_decode($edu->description, true);
                        @endphp
                        @if(is_array($eduPoints))
                            <ul style="margin: 0; padding-left: 20px;">
                                @foreach($eduPoints as $point)
                                    @if(trim($point) !== '')
                                        <li>{{ $point }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            {!! nl2br(e($edu->description)) !!}
                        @endif
                    </div>
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
                <table class="item-header-table">
                    <tr>
                        <td class="item-title">{{ $proj->title }}</td>
                        @if($proj->project_link)
                            <td class="item-date">
                                <a href="{{ $proj->project_link }}">{{ parse_url($proj->project_link, PHP_URL_HOST) }}</a>
                            </td>
                        @endif
                    </tr>
                </table>
                @if($proj->description)
                    <p class="item-desc">{{ $proj->description }}</p>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- SKILLS & TECHNOLOGIES -->
    @if($user->badges && $user->badges->count() > 0)
    <div class="section">
        <h2 class="section-title">Skills & Technologies</h2>
        <div class="skills-container">
            <span class="skills-label">Skills:</span>
            @php
                $skillNames = $user->badges->pluck('name')->toArray();
            @endphp
            {{ implode(', ', $skillNames) }}
        </div>
    </div>
    @endif

</body>
</html>
