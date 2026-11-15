<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>CV - {{ $user->name }}</title>
    <style>
        @page {
            margin: 16mm 18mm 16mm 18mm;
            size: A4 portrait;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #1E293B;
            margin: 0;
            padding: 0;
        }
        h1, h2, h3, h4, p {
            margin: 0;
        }
        
        /* Header Table */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            padding-bottom: 12px;
            border-bottom: 2px solid #0F172A;
        }
        .header-photo-cell {
            width: 2.8cm;
            vertical-align: top;
            padding-right: 14px;
        }
        .photo-box {
            width: 2.6cm;
            height: 3.3cm;
            overflow: hidden;
            border-radius: 4px;
            border: 1px solid #CBD5E1;
            text-align: center;
            line-height: 0;
            background-color: #F8FAFC;
        }
        .header-info-cell {
            vertical-align: top;
        }
        .candidate-name {
            font-size: 19pt;
            font-weight: bold;
            color: #0F172A;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.15;
            margin-bottom: 3px;
        }
        .candidate-title {
            font-size: 10pt;
            font-weight: bold;
            color: #FF4D2D;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }
        .contact-strip {
            font-size: 8.5pt;
            color: #475569;
            line-height: 1.6;
            margin-bottom: 6px;
        }
        .contact-strip a {
            color: #0F172A;
            text-decoration: none;
            font-weight: 500;
        }
        .summary-text {
            font-size: 8.5pt;
            color: #334155;
            line-height: 1.45;
            text-align: justify;
            margin-top: 4px;
        }

        /* Section Styling */
        .section {
            margin-bottom: 13px;
            page-break-inside: auto;
        }
        .section-header {
            font-size: 10.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #0F172A;
            border-bottom: 1.5px solid #0F172A;
            padding-bottom: 2px;
            margin-bottom: 8px;
            page-break-after: avoid;
        }
        
        /* Items inside Sections */
        .item {
            margin-bottom: 8px;
            page-break-inside: avoid;
        }
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }
        .item-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #0F172A;
            text-align: left;
        }
        .item-company {
            font-size: 9.5pt;
            font-weight: bold;
            color: #0F172A;
        }
        .item-role {
            font-size: 9pt;
            font-style: italic;
            color: #475569;
            margin-bottom: 3px;
        }
        .item-date {
            font-size: 8.5pt;
            color: #64748B;
            text-align: right;
            vertical-align: top;
            white-space: nowrap;
            width: 130px;
            font-style: italic;
        }
        .item-desc {
            font-size: 8.5pt;
            color: #334155;
            line-height: 1.4;
            text-align: justify;
        }
        .item-desc ul {
            margin: 2px 0 0 0;
            padding-left: 15px;
        }
        .item-desc li {
            margin-bottom: 2px;
        }

        /* 2-Column Project Layout */
        .project-item {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }
        .project-layout-table {
            width: 100%;
            border-collapse: collapse;
        }
        .project-col-left {
            width: 38%;
            vertical-align: top;
            padding-right: 14px;
        }
        .project-col-right {
            width: 62%;
            vertical-align: top;
        }
        .project-title {
            font-size: 9.5pt;
            font-weight: bold;
            color: #0F172A;
            line-height: 1.25;
            margin-bottom: 2px;
        }
        .project-link {
            font-size: 8pt;
            color: #FF4D2D;
            line-height: 1.3;
            margin-bottom: 4px;
            word-break: break-all;
        }
        .project-link a {
            color: #FF4D2D;
            text-decoration: none;
            font-weight: 500;
        }
        .project-photo-wrapper {
            width: 5.6cm;
            height: 3.2cm;
            overflow: hidden;
            border-radius: 4px;
            border: 1px solid #CBD5E1;
            background-color: #F8FAFC;
            text-align: center;
            line-height: 0;
            margin-top: 4px;
        }
        .project-desc {
            padding-top: 1px;
        }

        /* Skills Pill Layout */
        .skills-list {
            font-size: 8.5pt;
            color: #334155;
            line-height: 1.6;
        }
        .skill-badge {
            display: inline-block;
            background-color: #F1F5F9;
            border: 1px solid #E2E8F0;
            border-radius: 3px;
            padding: 1px 6px;
            margin-right: 4px;
            margin-bottom: 4px;
            font-size: 8pt;
            font-weight: 600;
            color: #1E293B;
        }
    </style>
</head>
<body>

    @php
        // Base64 encoding for the avatar to guarantee loading in DOMPDF
        $avatarBase64 = null;
        $avatarImgStyle = 'height: 3.3cm; width: auto;'; // fallback
        if (($includePhoto ?? true) && $user->avatar_path && file_exists(storage_path('app/public/' . $user->avatar_path))) {
            try {
                $path = storage_path('app/public/' . $user->avatar_path);
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $avatarBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                $imgInfo = @getimagesize($path);
                if ($imgInfo && $imgInfo[0] > 0 && $imgInfo[1] > 0) {
                    $w = $imgInfo[0];
                    $h = $imgInfo[1];
                    $targetRatio = 2.6 / 3.3; // Box ratio (~0.788)
                    $imgRatio = $w / $h;

                    if ($imgRatio > $targetRatio) {
                        // Image is wider than box: scale height to 3.3cm, width auto (excess cropped horizontally)
                        $avatarImgStyle = 'height: 3.3cm; width: auto; max-width: none;';
                    } else {
                        // Image is taller than box: scale width to 2.6cm, height auto (excess cropped vertically)
                        $avatarImgStyle = 'width: 2.6cm; height: auto; max-height: none;';
                    }
                }
            } catch (\Exception $e) {
                // Fail silently
            }
        }
    @endphp

    <!-- HEADER: CANDIDATE INFO & PHOTO -->
    <table class="header-table">
        <tr>
            @if($avatarBase64)
                <td class="header-photo-cell">
                    <div class="photo-box">
                        <img style="{{ $avatarImgStyle }}" src="{{ $avatarBase64 }}" alt="{{ $user->name }}">
                    </div>
                </td>
            @endif
            <td class="header-info-cell">
                <div class="candidate-name">{{ $user->name }}</div>
                @if($user->title)
                    <div class="candidate-title">{{ $user->title }}</div>
                @endif

                <!-- Contact Information -->
                <div class="contact-strip">
                    @php
                        $emailLink    = $user->socialLinks->where('icon', 'email')->first();
                        $whatsappLink = $user->socialLinks->where('icon', 'whatsapp')->first();
                        $linkedinLink = $user->socialLinks->where('icon', 'linkedin')->first();
                        $githubLink   = $user->socialLinks->where('icon', 'github')->first();

                        $contacts = [];

                        if (!empty($user->domicile)) {
                            $contacts[] = '<span>' . e($user->domicile) . '</span>';
                        }

                        if (!empty($user->birth_date)) {
                            $birthFormatted = \Carbon\Carbon::parse($user->birth_date)->locale('id')->isoFormat('D MMMM Y');
                            $contacts[] = '<span>Lahir: ' . $birthFormatted . '</span>';
                        }

                        if ($whatsappLink) {
                            $rawPhone = str_replace('https://wa.me/', '', $whatsappLink->link);
                            $phone    = '+' . ltrim($rawPhone, '+');
                            $contacts[] = '<span>WA: ' . $phone . '</span>';
                        }

                        if ($emailLink) {
                            $email = str_replace('mailto:', '', $emailLink->link);
                            $contacts[] = '<span>' . $email . '</span>';
                        } elseif ($user->email) {
                            $contacts[] = '<span>' . $user->email . '</span>';
                        }

                        if ($linkedinLink) {
                            $linkedinUrl = preg_replace('#^https?://(www\.)?#', '', $linkedinLink->link);
                            $contacts[] = '<span>' . $linkedinUrl . '</span>';
                        }

                        if ($githubLink) {
                            $githubUrl = preg_replace('#^https?://(www\.)?#', '', $githubLink->link);
                            $contacts[] = '<span>' . $githubUrl . '</span>';
                        }
                    @endphp
                    {!! implode(' &bull; ', $contacts) !!}
                </div>

                <!-- Professional Summary -->
                @if($user->bio)
                    <p class="summary-text">{!! nl2br(e($user->bio)) !!}</p>
                @endif
            </td>
        </tr>
    </table>

    <!-- 1. WORK EXPERIENCES (FILTERABLE) -->
    @if($user->experiences && $user->experiences->count() > 0)
        <div class="section">
            <div class="section-header">Pengalaman Kerja</div>
            @foreach($user->experiences as $exp)
                <div class="item">
                    <table class="item-table">
                        <tr>
                            <td class="item-title">
                                <span class="item-company">{{ $exp->company_name }}</span>
                            </td>
                            <td class="item-date">
                                {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') : '' }} &ndash;
                                {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : 'Sekarang' }}
                            </td>
                        </tr>
                    </table>
                    <div class="item-role">{{ $exp->position }}</div>

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
                                <p>{!! nl2br(e($exp->description)) !!}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- 2. EDUCATION -->
    @if(($includeEducation ?? true) && $user->educations && $user->educations->count() > 0)
        <div class="section">
            <div class="section-header">Riwayat Pendidikan</div>
            @foreach($user->educations as $edu)
                <div class="item">
                    <table class="item-table">
                        <tr>
                            <td class="item-title">
                                <span class="item-company">{{ $edu->institution_name }}</span>
                            </td>
                            <td class="item-date">
                                {{ $edu->start_year }} &ndash; {{ $edu->end_year ?? 'Sekarang' }}
                            </td>
                        </tr>
                    </table>
                    <div class="item-role">{{ $edu->degree }}</div>

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
                                <p>{!! nl2br(e($edu->description)) !!}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- 3. FEATURED PROJECTS -->
    @if(($includeProjects ?? true) && $user->projects && $user->projects->count() > 0)
        <div class="section">
            <div class="section-header">Proyek Unggulan</div>
            @foreach($user->projects as $proj)
                @php
                    $projImgBase64 = null;
                    $projImgStyle = 'width: 5.6cm; height: auto;'; // fallback

                    $foundPath = null;
                    if (!empty($proj->image_path)) {
                        $candidates = [
                            storage_path('app/public/' . $proj->image_path),
                            public_path($proj->image_path),
                            public_path('storage/' . $proj->image_path),
                        ];
                        foreach ($candidates as $c) {
                            if (file_exists($c) && is_file($c)) {
                                $foundPath = $c;
                                break;
                            }
                        }
                    }

                    if ($foundPath) {
                        try {
                            $ext = strtolower(pathinfo($foundPath, PATHINFO_EXTENSION));
                            $data = @file_get_contents($foundPath);
                            if ($data) {
                                $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : (($ext === 'png') ? 'image/png' : 'image/' . $ext);
                                $projImgBase64 = 'data:' . $mime . ';base64,' . base64_encode($data);

                                $imgInfo = @getimagesize($foundPath);
                                if ($imgInfo && $imgInfo[0] > 0 && $imgInfo[1] > 0) {
                                    $w = $imgInfo[0];
                                    $h = $imgInfo[1];
                                    $targetRatio = 5.6 / 3.2; // ~1.75
                                    $imgRatio = $w / $h;

                                    if ($imgRatio > $targetRatio) {
                                        $projImgStyle = 'height: 3.2cm; width: auto; max-width: none;';
                                    } else {
                                        $projImgStyle = 'width: 5.6cm; height: auto; max-height: none;';
                                    }
                                }
                            }
                        } catch (\Throwable $e) {
                            // Silently ignore formatting errors
                        }
                    }

                    if (!$projImgBase64 && !empty($proj->thumbnail_url) && preg_match('#^https?://#', $proj->thumbnail_url)) {
                        $projImgBase64 = $proj->thumbnail_url;
                        $projImgStyle = 'width: 5.6cm; height: auto; max-height: 3.2cm;';
                    }

                    $descText = !empty($proj->cv_description) 
                        ? trim($proj->cv_description) 
                        : \Illuminate\Support\Str::limit(strip_tags($proj->description), 280);
                @endphp

                <div class="item project-item">
                    <table class="project-layout-table">
                        <tr>
                            <!-- Kolom 1: Title, Link, dan Foto Proyek -->
                            <td class="project-col-left">
                                <div class="project-title">{{ $proj->title }}</div>
                                @if($proj->project_link)
                                    <div class="project-link">
                                        <a href="{{ $proj->project_link }}" target="_blank">
                                            {{ preg_replace('#^https?://#', '', $proj->project_link) }}
                                        </a>
                                    </div>
                                @endif
                                @if($projImgBase64)
                                    <div class="project-photo-wrapper">
                                        <img src="{{ $projImgBase64 }}" alt="{{ $proj->title }}" style="{{ $projImgStyle }}">
                                    </div>
                                @endif
                            </td>

                            <!-- Kolom 2: Deskripsi Proyek -->
                            <td class="project-col-right">
                                @if($descText)
                                    <div class="item-desc project-desc">
                                        <p>{!! nl2br(e($descText)) !!}</p>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            @endforeach
        </div>
    @endif

    <!-- 4. SKILLS & TECHNOLOGIES -->
    @if(($includeSkills ?? true) && $user->badges && $user->badges->count() > 0)
        <div class="section">
            <div class="section-header">Keahlian &amp; Teknologi</div>
            <div class="skills-list">
                @foreach($user->badges as $badge)
                    <span class="skill-badge">{{ $badge->name }}</span>
                @endforeach
            </div>
        </div>
    @endif

</body>
</html>
