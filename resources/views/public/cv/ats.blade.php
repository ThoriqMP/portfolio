<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->name }}</title>
    <style>
        @page {
            margin: 25px 30px;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            line-height: 1.35;
            color: #333333;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4 {
            margin: 0;
            color: #000000;
        }
        h1 {
            font-size: 18pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .subtitle {
            font-size: 10pt;
            color: #555555;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .header-cell-left {
            width: 85px;
            vertical-align: top;
            padding-right: 12px;
        }
        .header-cell-right {
            vertical-align: middle;
        }
        .avatar {
            width: 75px;
            height: 75px;
            border-radius: 6px; /* rounded rectangle, not circle */
            object-fit: cover;
            border: 1.5px solid #cccccc;
        }
        .contact-info {
            font-size: 8.5pt;
            color: #444444;
            line-height: 1.6;
            margin-bottom: 4px;
        }
        .contact-info a {
            color: #444444;
            text-decoration: none;
        }
        /* Bio text inline below contact — no section heading */
        .bio-text {
            font-size: 8.5pt;
            color: #444444;
            margin: 0;
            text-align: justify;
        }
        .section {
            margin-bottom: 12px;
        }
        .section-title {
            font-size: 11pt;
            text-transform: uppercase;
            font-weight: bold;
            border-bottom: 1.5px solid #000000;
            padding-bottom: 1px;
            margin-bottom: 8px;
            color: #000000;
            letter-spacing: 0.5px;
        }
        
        /* Layout Two Columns */
        .content-table {
            width: 100%;
            border-collapse: collapse;
        }
        .col-left {
            width: 58%;
            vertical-align: top;
            padding-right: 15px;
            border-right: 1px solid #dddddd;
        }
        .col-right {
            width: 42%;
            vertical-align: top;
            padding-left: 15px;
        }

        .item {
            margin-bottom: 8px;
        }
        .item-header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        /* Company / Institution name: bold with teal accent */
        .item-title {
            font-weight: bold;
            font-size: 9.5pt;
            color: #1a7a6b;
            text-align: left;
        }
        /* Project title: stays dark */
        .item-title-project {
            font-weight: bold;
            font-size: 9.5pt;
            color: #111111;
            text-align: left;
        }
        .item-date {
            text-align: right;
            font-style: italic;
            font-size: 8.5pt;
            color: #555555;
            width: 110px;
        }
        .item-subtitle-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3px;
        }
        /* Role / Degree: italic only (not bold), below company/institution */
        .item-subtitle {
            font-style: italic;
            font-size: 9pt;
            color: #333333;
            text-align: left;
        }
        .item-desc {
            margin: 0;
            text-align: justify;
            font-size: 8.5pt;
            color: #333333;
        }
        .item-desc ul {
            margin: 0;
            padding-left: 14px;
        }
        .item-desc li {
            margin-bottom: 2px;
        }
        .skills-container {
            font-size: 8.5pt;
            line-height: 1.4;
        }
        .skills-badge {
            display: inline-block;
            background-color: #f0f0f0;
            border: 1px solid #cccccc;
            padding: 1px 5px;
            margin-right: 3px;
            margin-bottom: 4px;
            font-size: 8pt;
            border-radius: 3px;
            color: #333333;
        }
        p {
            margin: 0;
        }
    </style>
</head>
<body>

    @php
        // Base64 encoding for the avatar to guarantee loading in DOMPDF
        $avatarBase64 = null;
        if ($user->avatar_path && file_exists(storage_path('app/public/' . $user->avatar_path))) {
            try {
                $path = storage_path('app/public/' . $user->avatar_path);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $avatarBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } catch (\Exception $e) {
                // Fail silently
            }
        }
    @endphp

    <!-- HEADER SECTION -->
    <table class="header-table">
        <tr>
            @if($avatarBase64)
                <td class="header-cell-left">
                    <img class="avatar" src="{{ $avatarBase64 }}" alt="Profile Picture">
                </td>
            @endif
            <td class="header-cell-right">
                <h1>{{ $user->name }}</h1>
                @if($user->title)
                    <div class="subtitle">{{ $user->title }}</div>
                @endif
                <div class="contact-info">
                    @php
                        $emailLink    = $user->socialLinks->where('icon', 'email')->first();
                        $whatsappLink = $user->socialLinks->where('icon', 'whatsapp')->first();
                        $linkedinLink = $user->socialLinks->where('icon', 'linkedin')->first();
                        $githubLink   = $user->socialLinks->where('icon', 'github')->first();

                        $contactDetails = [];

                        if ($whatsappLink) {
                            // Extract phone number from wa.me URL
                            $rawPhone = str_replace('https://wa.me/', '', $whatsappLink->link);
                            $phone    = '+' . ltrim($rawPhone, '+');
                            $contactDetails[] = '<a href="' . $whatsappLink->link . '">' . $phone . '</a>';
                        }

                        if ($emailLink) {
                            $email = str_replace('mailto:', '', $emailLink->link);
                            $contactDetails[] = '<a href="' . $emailLink->link . '">' . $email . '</a>';
                        }

                        if ($linkedinLink) {
                            $linkedinUrl = preg_replace('#^https?://#', '', $linkedinLink->link);
                            $contactDetails[] = '<a href="' . $linkedinLink->link . '">' . $linkedinUrl . '</a>';
                        }

                        if ($githubLink) {
                            $githubUrl = preg_replace('#^https?://#', '', $githubLink->link);
                            $contactDetails[] = '<a href="' . $githubLink->link . '">' . $githubUrl . '</a>';
                        }
                    @endphp
                    {!! implode(' | ', $contactDetails) !!}
                </div>

                {{-- Bio shown inline below contact — no section heading --}}
                @if($user->bio)
                    <p class="bio-text">{!! nl2br(e($user->bio)) !!}</p>
                @endif
            </td>
        </tr>
    </table>

    {{-- Professional Summary removed as heading; bio is now inline in the header above --}}

    <!-- TWO COLUMNS LAYOUT -->
    <table class="content-table">
        <tr>
            <!-- LEFT COLUMN: WORK EXPERIENCE -->
            <td class="col-left">
                @if($user->experiences && $user->experiences->count() > 0)
                <div class="section">
                    <h2 class="section-title">Pengalaman Bekerja</h2>
                    @foreach($user->experiences as $exp)
                        <div class="item">
                            {{-- Company name (bold + teal) on left, date on right --}}
                            <table class="item-header-table">
                                <tr>
                                    <td class="item-title">{{ $exp->company_name }}</td>
                                    <td class="item-date">
                                        {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->format('M Y') : '' }} &ndash;
                                        {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('M Y') : 'Present' }}
                                    </td>
                                </tr>
                            </table>
                            {{-- Role / Position (italic) below company --}}
                            <table class="item-subtitle-table">
                                <tr>
                                    <td class="item-subtitle">{{ $exp->position }}</td>
                                </tr>
                            </table>
                            @if($exp->description)
                                <div class="item-desc">
                                    @php
                                        $points = json_decode($exp->description, true);
                                    @endphp
                                    @if(is_array($points))
                                        <ul>
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
            </td>

            <!-- RIGHT COLUMN: EDUCATION, PROJECTS & SKILLS -->
            <td class="col-right">
                <!-- EDUCATION -->
                @if($user->educations && $user->educations->count() > 0)
                <div class="section">
                    <h2 class="section-title">Riwayat Pendidikan</h2>
                    @foreach($user->educations as $edu)
                        <div class="item">
                            {{-- Institution name (bold + teal) on left, year range on right --}}
                            <table class="item-header-table">
                                <tr>
                                    <td class="item-title">{{ $edu->institution_name }}</td>
                                    <td class="item-date">
                                        {{ $edu->start_year }} &ndash; {{ $edu->end_year ?? 'Pres' }}
                                    </td>
                                </tr>
                            </table>
                            {{-- Degree (italic) below institution --}}
                            <table class="item-subtitle-table">
                                <tr>
                                    <td class="item-subtitle">{{ $edu->degree }}</td>
                                </tr>
                            </table>
                            @if($edu->description)
                                <div class="item-desc">
                                    @php
                                        $eduPoints = json_decode($edu->description, true);
                                    @endphp
                                    @if(is_array($eduPoints))
                                        <ul>
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
                                    <td class="item-title-project">{{ $proj->title }}</td>
                                    @if($proj->project_link)
                                        <td class="item-date">
                                            <a href="{{ $proj->project_link }}" style="color:#1a7a6b;">Link</a>
                                        </td>
                                    @endif
                                </tr>
                            </table>
                            @if($proj->description)
                                <p class="item-desc">{{ \Illuminate\Support\Str::limit($proj->description, 120) }}</p>
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
                        @foreach($user->badges as $badge)
                            <span class="skills-badge">{{ $badge->name }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </td>
        </tr>
    </table>

</body>
</html>
