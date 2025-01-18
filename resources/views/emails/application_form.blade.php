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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
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

    <p><strong>Position Applied For:</strong> {{ $form['positionApplied'] ?? '' }}</p>
    <p><strong>Name:</strong> {{ $form['fullName'] ?? '' }}</p>
    <p><strong>Father/Husband's Name:</strong> {{ $form['fatherOrHusbandName'] ?? '' }}</p>
    <p><strong>Address:</strong> {{ $form['currentAddress'] ?? '' }}</p>
    <p><strong>Phone:</strong> {{ $form['phoneNumber'] ?? '' }}</p>
    <p><strong>Email:</strong> {{ $form['email'] ?? '' }}</p>
    <p><strong>Date of Birth:</strong> {{ $form['dateOfBirth'] ?? '' }}</p>
    <p><strong>Place of Birth:</strong> {{ $form['placeOfBirth'] ?? '' }}</p>
    <p><strong>Marital Status:</strong> {{ $form['maritalStatus'] ?? '' }}</p>
    <p><strong>Spouse's Name:</strong> {{ $form['spouseName'] ?? '' }}</p>
    <p><strong>Nationality:</strong> {{ $form['nationality'] ?? 'Indian' }}</p>

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
                    <td>{{ $record['yearPassed'] }}</td>
                    <td>{{ $record['institution'] }}</td>
                    <td>{{ $record['mainSubjects'] }}</td>
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
            @foreach ($form['professionalMembership'] ?? [] as $membership)
                <tr>
                    <td>{{ $membership['organization'] }}</td>
                    <td>{{ $membership['dateSince'] }}</td>
                    <td>{{ $membership['contribution'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Employment History</h3>
    <table>
        <thead>
            <tr>
                <th>Month & Year</th>
                <th>Position</th>
                <th>Organization</th>
                <th>Responsibilities</th>
                <th>Reason for Leaving</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($form['employmentHistory'] ?? [] as $history)
                <tr>
                    <td>{{ $history['monthAndYear'] }}</td>
                    <td>{{ $history['position'] }}</td>
                    <td>{{ $history['organization'] }}</td>
                    <td>{{ $history['responsibilities'] }}</td>
                    <td>{{ $history['reasonForLeaving'] }}</td>
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
                    <td>{{ $reference['serialNo'] }}</td>
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
            @foreach ($form['particulars'] ?? [] as $particular)
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
        </tbody>
    </table>

    <p><strong>Expected CTC:</strong> {{ $form['expectedCTC'] ?? '' }}</p>
    <p><strong>Notice Period:</strong> {{ $form['noticePeriod'] ?? '' }}</p>
    <p><strong>Convicted:</strong> {{ $form['convicted'] ?? 'No' }}</p>
    <p><strong>Interviewed:</strong> {{ $form['interviewed'] ?? 'No' }}</p>

    <p>
        I affirm that I have not provided any wrong information that may affect my candidacy.
        <br>
        <strong>Place:</strong> {{ $form['place'] ?? '' }}<br>
        <strong>Date:</strong> {{ $form['date'] ?? '' }}
    </p>

    <p>Regards,<br>{{ $form['fullName'] ?? '' }}</p>
</body>

</html>
