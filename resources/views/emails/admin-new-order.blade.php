<div style="font-family: sans-serif; text-transform: uppercase; color: #0f172a; padding: 20px;">
    <h1 style="font-weight: 900; color: #D9480F; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px;">LOGISTICS ALERT</h1>
    <p style="font-weight: 800; font-size: 16px; margin-top: 20px;">NEW DEPLOYMENT LOGGED</p>
    
    <div style="background: #f8fafc; padding: 20px; border-left: 4px solid #D9480F; margin: 20px 0;">
        <p style="font-size: 11px; font-weight: 900; color: #64748b; margin: 0 0 10px 0;">MANIFEST DATA:</p>
        <p style="font-size: 14px; font-weight: 800; margin: 5px 0;">REFERENCE: #{{ $order->order_number }}</p>
        <p style="font-size: 14px; font-weight: 800; margin: 5px 0;">VALUE: ₦{{ number_format($order->total_amount) }}</p>
        <p style="font-size: 14px; font-weight: 800; margin: 5px 0;">RECIPIENT: {{ $order->first_name }} {{ $order->last_name }}</p>
    </div>

    <p style="font-size: 11px; font-weight: 700; color: #ef4444;">ACTION REQUIRED: VERIFY BANK TRANSFER EVIDENCE IN FINANCE TERMINAL.</p>

    <div style="margin-top: 30px;">
        <a href="{{ url('/admin/payments') }}" style="display: inline-block; background: #D9480F; color: white; padding: 15px 25px; text-decoration: none; font-weight: 900; font-size: 10px; letter-spacing: 0.2em; margin-right: 10px;">VERIFY PAYMENT</a>
        <a href="{{ url('/admin/orders/'.$order->id) }}" style="display: inline-block; background: #062419; color: white; padding: 15px 25px; text-decoration: none; font-weight: 900; font-size: 10px; letter-spacing: 0.2em;">VIEW MANIFEST</a>
    </div>
</div>