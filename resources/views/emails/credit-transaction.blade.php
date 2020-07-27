<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
        </tr>
        <tr>
            <td align="center" valign="top" bgcolor="#f1f69d"
                style="background-color:#f1f69d; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:10px;">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                    <tr>
                        <td align="left" valign="top"
                            style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#525252;">
                            <div
                                style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:56px; color:#000000;">
                                New Credit Transaction<span style="color:#478730;">*</span></div>
                            <div><br>
                                A credit transaction just occured on your account. Kindly see the details below.</div>
                            <p>Amount: {{ $data->amount }}</p>
                            <p>Sender: {{ Auth::user()->first_name." ".Auth::user()->last_name }}</p>
                            <p>Narration: <br>{{ $data->narration }}</p>
                            <p>Date and Time:: {{ date('Y-m-d H:i:s') }}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="left" valign="top" bgcolor="#478730" style="background-color:#478730;">
                <table width="100%" border="0" cellspacing="0" cellpadding="15">
                    <tr>
                        <td align="left" valign="top"
                            style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px;">Company
                            Address <br>
                            Contact Person <br>
                            Phone: (123) 456-789 <br>
                            Email: <a href="mailto:name@yourcompanyname.com"
                                style="color:#ffffff; text-decoration:none;">name@yourcompanyname.com </a><br>
                            Website: <a href="http://www.yourcompanyname.com" target="_blank"
                                style="color:#ffffff; text-decoration:none;">www.yourcompanyname.com</a></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
