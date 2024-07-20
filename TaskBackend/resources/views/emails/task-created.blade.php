<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Task Created</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; margin: 0; padding: 0;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td style="padding: 20px 0;">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <tr>
                    <td style="padding: 40px 30px;">
                        <h1 style="color: #333333; font-size: 24px; margin-bottom: 20px; text-align: center;">New Task Created</h1>

                        <p style="color: #666666; font-size: 16px; margin-bottom: 20px;">A new task has been created in your system. Here are the details:</p>

                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-bottom: 20px; border: 1px solid #e0e0e0; border-radius: 4px;">
                            <tr>
                                <td style="padding: 10px; background-color: #f8f8f8; font-weight: bold; width: 30%;">Title:</td>
                                <td style="padding: 10px;">{{ $task->title }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; background-color: #f8f8f8; font-weight: bold;">Description:</td>
                                <td style="padding: 10px;">{{ $task->description }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; background-color: #f8f8f8; font-weight: bold;">Created by:</td>
                                <td style="padding: 10px;">Kelvin Githu</td>
{{--                                <td style="padding: 10px;">{{ $task->user->name }}</td>--}}
                            </tr>
                        </table>

                        <p style="color: #666666; font-size: 16px; margin-bottom: 20px;">Please take appropriate action or assign this task as needed.</p>

                        <div style="text-align: center;">
                            <a href="{{ url('/tasks/' . $task->id) }}" style="display: inline-block; background-color: #007bff; color: #ffffff; text-decoration: none; padding: 10px 20px; border-radius: 4px; font-weight: bold;">View Task</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: #f8f8f8; padding: 20px 30px; text-align: center; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                        <p style="color: #999999; font-size: 14px; margin: 0;">This is an automated message. Please do not reply to this email.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
