<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Initial Evaluation Result</title>
</head>
<body style="margin:0;padding:0;background:#ffffff;font-family:'Times New Roman',Times,serif;">
    <table cellpadding="0" cellspacing="0" width="100%" style="background:#ffffff;">
        <tr>
            <td align="center">
                <table cellpadding="0" cellspacing="0" width="650" style="background:#ffffff;">

                    {{-- Annex label --}}
                    <tr>
                        <td style="padding:25px 35px 5px 35px;text-align:right;font-size:13px;font-weight:bold;color:#000000;">
                            ANNEX {{ $status === 'qualified' ? 'E' : 'F' }}
                        </td>
                    </tr>

                    {{-- Letterhead --}}
                    <tr>
                        <td style="padding:5px 35px 15px 35px;text-align:center;">
                            <p style="margin:0 0 4px 0;font-size:18px;font-weight:bold;color:#000000;">Republic of the Philippines</p>
                            <p style="margin:0 0 4px 0;font-size:14px;color:#000000;">Department of Education</p>
                            <p style="margin:0 0 4px 0;font-size:13px;color:#000000;">{{ config('deped.office_name') }}</p>
                            <p style="margin:0;font-size:12px;font-weight:bold;color:#000000;">PERSONNEL DIVISION</p>
                        </td>
                    </tr>

                    {{-- Date --}}
                    <tr>
                        <td style="padding:10px 35px 5px 35px;font-size:13px;color:#000000;">
                            {{ $date }}
                        </td>
                    </tr>

                    {{-- Applicant info --}}
                    <tr>
                        <td style="padding:5px 35px 5px 35px;font-size:13px;color:#000000;">
                            {{ $applicantName }}<br>
                            {{ $applicantAddress }}
                        </td>
                    </tr>

                    {{-- Salutation --}}
                    <tr>
                        <td style="padding:15px 35px 10px 35px;font-size:13px;color:#000000;">
                            Dear <strong>{{ $applicantName }}</strong>,
                        </td>
                    </tr>

                    {{-- Body intro --}}
                    <tr>
                        <td style="padding:0 35px 15px 35px;font-size:13px;color:#000000;line-height:1.6;">
                            @if($status === 'qualified')
                                <p style="margin:0 0 10px 0;"><strong>Congratulations!</strong></p>
                                <p style="margin:0 0 10px 0;">We are pleased to inform you that based on the initial evaluation, we have found your qualifications to be substantial vis-à-vis the Civil Service Commission (CSC) approved Qualification Standards (QS) of <strong>{{ $positionName }}</strong> position under <strong>{{ config('deped.office_name') }}</strong>. Below are the results of the initial evaluation conducted by the undersigned dated <strong>{{ $date }}</strong>:</p>
                            @else
                                <p style="margin:0 0 10px 0;">Please be informed of the results of the initial evaluation of your qualifications vis-à-vis the Civil Service Commission (CSC) approved-Qualification Standards (QS) of <strong>{{ $positionName }}</strong> position under <strong>{{ config('deped.office_name') }}</strong>, as follows:</p>
                            @endif
                        </td>
                    </tr>

                    {{-- Table --}}
                    <tr>
                        <td style="padding:0 35px 15px 35px;">
                            <table cellpadding="0" cellspacing="0" width="100%" style="border:1px solid #666;border-collapse:collapse;font-size:12px;">
                                <thead>
                                    <tr style="background:#7A7B93;color:#ffffff;">
                                        <th style="border:1px solid #666;padding:10px;text-align:left;width:26%;font-weight:bold;">Position Applied for</th>
                                        <th style="border:1px solid #666;padding:10px;text-align:left;width:28%;font-weight:bold;">CSC-approved QS of the Position</th>
                                        <th style="border:1px solid #666;padding:10px;text-align:left;width:26%;font-weight:bold;">Your Qualifications</th>
                                        <th style="border:1px solid #666;padding:10px;text-align:left;width:20%;font-weight:bold;">Remarks/Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sectors = ['education', 'experience', 'training', 'eligibility'];
                                        $sectorLabels = ['Education', 'Experience', 'Training', 'Eligibility'];
                                        $positionDisplay = $positionName . '<br>Plantilla Item No.: ' . $plantillaItemNo;
                                    @endphp
                                    @foreach($sectors as $i => $sector)
                                        @php $data = $sectorData[$sector] ?? null; @endphp
                                        <tr>
                                            @if($i === 0)
                                                <td style="border:1px solid #666;padding:10px;vertical-align:top;font-weight:bold;color:#000000;" rowspan="4">
                                                    {!! $positionDisplay !!}
                                                </td>
                                            @endif
                                            <td style="border:1px solid #666;padding:10px;vertical-align:top;color:#000000;">
                                                <strong>{{ $sectorLabels[$i] }}:</strong><br>
                                                {{ $data['required_qs'] ?? '—' }}
                                            </td>
                                            <td style="border:1px solid #666;padding:10px;vertical-align:top;color:#000000;">
                                                {{ $data['qualifications'] ?: '—' }}
                                            </td>
                                            <td style="border:1px solid #666;padding:10px;vertical-align:top;color:#000000;">
                                                {{ ucfirst($data['status'] ?? 'pending') }}
                                                @if(!empty($data['remarks']))
                                                    <br><span style="color:#333333;">{{ $data['remarks'] }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    {{-- Body paragraphs --}}
                    <tr>
                        <td style="padding:0 35px 15px 35px;font-size:13px;color:#000000;line-height:1.6;">
                            @if(isset($bodyText))
                                @php $paras = explode("\n\n", $bodyText); @endphp
                                @foreach($paras as $para)
                                    @if(trim($para))
                                        <p style="margin:0 0 10px 0;">{{ $para }}</p>
                                    @endif
                                @endforeach
                            @elseif($status === 'qualified')
                                <p style="margin:0 0 10px 0;">Please be advised of your assigned application code <strong>{{ $applicationCode }}</strong> which shall be used as you proceed with the next stage of the selection process. You may refer to the official issuances of {{ config('deped.office_name') }} for additional announcements in this regard. For inquiries, you may communicate with {{ config('deped.office_name') }} at {{ config('deped.telephone') }} or {{ config('deped.email') }}.</p>
                                <p style="margin:0;">Thank you.</p>
                            @else
                                <p style="margin:0 0 10px 0;">While your qualifications made a favorable impression, we regret to inform you that you did not meet the minimum QS set for <strong>{{ $positionName }}</strong> position. You may, however, continue to submit job applications in response to other vacancy announcements that we publish at <a href="https://www.csc.gov.ph/careers" style="color:#000000;">www.csc.gov.ph/careers</a>, DepEd bulletin boards, and official website (you may insert online links of other job portals, if necessary).</p>
                                <p style="margin:0 0 10px 0;">The results of the initial evaluation shall be released and posted for transparency purposes. You may refer to your assigned application code <strong>{{ $applicationCode }}</strong> in the official posting of the results.</p>
                                <p style="margin:0;">Thank you and we wish you the best of luck in your future success.</p>
                            @endif
                        </td>
                    </tr>

                    {{-- Signatory --}}
                    <tr>
                        <td style="padding:15px 35px 30px 35px;font-size:13px;color:#000000;">
                            <p style="margin:0 0 5px 0;">Very truly yours,</p>
                            <br><br>
                            <p style="margin:0 0 2px 0;"><strong>{{ config('deped.hrmo_name') }}</strong></p>
                            <p style="margin:0 0 2px 0;">{{ config('deped.hrmo_position') }}</p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:0 35px;">
                            <hr style="border:none;border-top:1px solid #999;margin:0;">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:10px 35px 25px 35px;text-align:left;font-size:11px;color:#666666;line-height:1.5;">
                            {{ config('deped.office_address') }}<br>
                            Tel. Nos.: {{ config('deped.telephone') }} | Email: {{ config('deped.email') }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
