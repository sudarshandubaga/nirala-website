<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            max-width: 1000px;
            margin: 0 auto;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px !important;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 3px;
        }

        th {
            background-color: #f4f4f4;
            text-align: left;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h2>Employment Application Form</h2>

    <table>
        <tr>
            <th>Position Applied For:</th>
            <td>{{ $form['career_post']['title'] ?? '' }}</td>
            <td rowspan="11" style="width: 250px; text-align: center;">
                <div style="margin-bottom: 5px;">
                    <img src="{{ public_path('storage/' . $form['image']) }}" alt=""
                        style="max-width: 200px; border: 1px solid #ccc; padding: 5px;">
                </div>
                <div style="margin-bottom: 5px;">
                    <img src="{{ public_path('storage/' . $form['sign']) }}" alt=""
                        style="max-width: 200px; border: 1px solid #ccc; padding: 5px;">
                </div>
            </td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>
                {{ $form['full_name'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Father/Husband's Name:</th>
            <td>
                {{ $form['father_or_husband_name'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Current Address:</th>
            <td>
                {{ $form['current_address'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Permanent Address:</th>
            <td>
                {{ $form['permanent_address'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Mobile No.:</th>
            <td>{{ $form['phone_number'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Mobile No. (Alternate):</th>
            <td>{{ $form['alt_mobile_no'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
                {{ $form['email'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Date of Birth:</th>
            <td>
                {{ $form['date_of_birth'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Place of Birth:</th>
            <td>
                {{ $form['place_of_birth'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Marital Status:</th>
            <td>
                {{ $form['marital_status'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Spouse's Name:</th>
            <td>
                {{ $form['spouse_name'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Spouse's Mobile No.:</th>
            <td>
                {{ $form['spouse_mobile'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Spouse's Occupation:</th>
            <td>
                {{ $form['spouse_occupation'] ?? '' }}</td>
        </tr>
        <tr>
            <th>Nationality:</th>
            <td>
                {{ $form['nationality'] ?? 'Indian' }}</td>
        </tr>
    </table>


    <h3 class="section-title">Academic Record</h3>
    <table>
        <thead>
            <tr>
                <th>Qualification</th>
                <th>Year Passed</th>
                <th>Institution</th>
                <th>Main Subjects</th>
                <th>Percentage</th>
                <th>Achievements</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form['records'] ?? [] as $record)
                <tr>
                    <td>{{ $record['qualification'] }}</td>
                    <td>{{ $record['year_passed'] }}</td>
                    <td>{{ $record['institution'] }}</td>
                    <td>{{ $record['main_subjects'] }}</td>
                    <td>{{ $record['percentage'] }}</td>
                    <td>{{ $record['achievements'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Professional Membership</h3>
    <table>
        <thead>
            <tr>
                <th>Organization</th>
                <th>Date Since</th>
                <th>Contribution</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form['professional_membership'] ?? [] as $membership)
                <tr>
                    <td>{{ $membership['organization'] }}</td>
                    <td>{{ $membership['date_since'] }}</td>
                    <td>{{ $membership['contribution'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Employment History</h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">From</th>
                <th rowspan="2">To</th>
                <th rowspan="2">Employer</th>
                <th colspan="2">Designation</th>
                <th rowspan="2">Job Description</th>
                <th colspan="2">Salary</th>
                <th rowspan="2">Reason Of Leaving</th>
            </tr>
            <tr>
                <th>On Joining</th>
                <th>On Leaving</th>
                <th>On Joining</th>
                <th>On Leaving</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form['employment_history'] ?? [] as $history)
                <tr>
                    <td>{{ $history['from'] }}</td>
                    <td>{{ $history['to'] }}</td>
                    <td>{{ $history['employer'] }}</td>
                    <td>{{ $history['designation_on_joining'] }}</td>
                    <td>{{ $history['designation_on_leaving'] }}</td>
                    <td>{{ $history['job_description'] }}</td>
                    <td>{{ $history['salary_on_joining'] }}</td>
                    <td>{{ $history['salary_on_leaving'] }}</td>
                    <td>{{ $history['reason_of_leaving'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">References</h3>
    <table>
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Name</th>
                <th>Company</th>
                <th>Designation</th>
                <th>Capacity</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form['references'] ?? [] as $reference)
                <tr>
                    <td>{{ $reference['serial_no'] }}</td>
                    <td>{{ $reference['name'] }}</td>
                    <td>{{ $reference['company'] }}</td>
                    <td>{{ $reference['designation'] }}</td>
                    <td>{{ $reference['capacity'] }}</td>
                    <td>{{ $reference['contact'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Particulars (Remuneration)</h3>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($form['particulars'] ?? [] as $particular)
                @php
                    $total += $item['amount'] ?? 0;
                @endphp
                <tr>
                    <td rowspan="{{ count($particular['items']) }}">{{ $particular['title'] }}</td>
                    @foreach ($particular['items'] as $index => $item)
                        @if ($index > 0)
                <tr>
            @endif
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['amount'] }}</td>
            <td>{{ $item['remarks'] }}</td>
            </tr>
            @endforeach
            </tr>
            @endforeach
            <tr>
                <td colspan="2">Total</td>
                <td colspan="2">{{ $total }}</td>
            </tr>
        </tbody>
    </table>

    <p style="display: flex; justify-content: space-between"><strong>Expected CTC:</strong>
        {{ $form['expected_ctc'] ?? '' }}</p>
    <p style="display: flex; justify-content: space-between"><strong>Notice Period:</strong>
        {{ $form['notice_period'] ?? '' }}</p>
    <p style="display: flex; justify-content: space-between"><strong>Convicted:</strong>
        {{ $form['convicted'] ?? 'No' }}</p>
    <p style="display: flex; justify-content: space-between"><strong>Interviewed:</strong>
        {{ $form['interviewed'] ?? 'No' }}</p>

    <p>Regards,<br>{{ $form['full_name'] ?? '' }}</p>
</body>

</html>
