<div style="font-family: sans-serif; text-transform: uppercase; color: #0f172a;">
    <h1 style="font-weight: 900; letter-spacing: -0.05em; border-bottom: 4px solid #D9480F; padding-bottom: 10px;">
        QUICKLIGHTER <span style="color: #D9480F;">LOGISTICS</span>
    </h1>
    
    <p style="font-weight: bold; font-size: 14px; margin-top: 30px;">
        REFERENCE ID: #{{ $order->order_number }}
    </p>

    <div style="background: #f8fafc; padding: 20px; border: 1px solid #e2e8f0; margin: 20px 0;">
        <p style="font-weight: 900; font-size: 10px; color: #64748b; letter-spacing: 0.2em;">SYSTEM NOTIFICATION:</p>
        <p style="font-weight: 800; font-size: 18px; color: #D9480F;">
            @if($type == 'CONFIRMATION') DEPLOYMENT LOGGED & AWAITING CLEARANCE
            @elseif($type == 'PAYMENT_APPROVED') FINANCIAL CLEARANCE GRANTED
            @elseif($type == 'PAYMENT_REJECTED') FINANCIAL EVIDENCE DISPUTED
            @else LOGISTICS STATUS: {{ strtoupper($order->status) }}
            @endif
        </p>
    </div>

    <p style="font-size: 12px; line-height: 2; font-weight: 600;">
        GREETINGS {{ $order->first_name }},<br>
        YOUR ORDER HAS BEEN UPDATED IN OUR CENTRAL REGISTRY. YOU CAN TRACK THE REAL-TIME DEPLOYMENT PROGRESS USING THE LINK BELOW.
    </p>

    <a href="{{ route('track.search', ['order_number' => $order->order_number]) }}" 
       style="display: inline-block; background: #062419; color: white; padding: 15px 30px; text-decoration: none; font-weight: 900; font-size: 11px; letter-spacing: 0.2em; margin-top: 20px;">
        ACCESS TRACKING TERMINAL
    </a>

    <hr style="margin-top: 40px; border: none; border-top: 1px solid #e2e8f0;">
    <p style="font-size: 9px; color: #94a3b8; font-weight: bold; letter-spacing: 0.1em;">
        QUICKLIGHTER INDUSTRIES | PRECISION ENGINEERING | NIGERIA
    </p>
</div>