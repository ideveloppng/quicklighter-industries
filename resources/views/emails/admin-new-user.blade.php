<div style="font-family: sans-serif; text-transform: uppercase; color: #0f172a; padding: 20px;">
    <h1 style="font-weight: 900; color: #D9480F; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">SYSTEM ALERT</h1>
    <p style="font-weight: 800; font-size: 16px; margin-top: 20px;">NEW PERSONNEL REGISTERED</p>
    
    <div style="background: #f8fafc; padding: 20px; border-left: 4px solid #062419; margin: 20px 0;">
        <p style="font-size: 11px; font-weight: 900; color: #64748b; margin: 0 0 10px 0;">IDENTITY DETAILS:</p>
        <p style="font-size: 14px; font-weight: 800; margin: 5px 0;">NAME: {{ $user->name }}</p>
        <p style="font-size: 14px; font-weight: 800; margin: 5px 0;">EMAIL: {{ $user->email }}</p>
        <p style="font-size: 14px; font-weight: 800; margin: 5px 0;">PHONE: {{ $user->phone ?? 'NOT PROVIDED' }}</p>
    </div>

    <a href="{{ url('/admin/users') }}" style="display: inline-block; background: #062419; color: white; padding: 15px 25px; text-decoration: none; font-weight: 900; font-size: 10px; letter-spacing: 0.2em;">ACCESS PERSONNEL REGISTRY</a>
</div>