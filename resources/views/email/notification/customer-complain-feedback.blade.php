<div style="font-family: Helvetica, Arial, sans-serif; min-width: 1000px; overflow: auto; line-height: 2">
    <div style="margin: 50px auto; width: 70%; padding: 20px 0">
        <div style="border-bottom: 1px solid #eee">
            <a href="" style="font-size: 1.4em; color: #00466a; text-decoration: none; font-weight: 600">Your Brand</a>
        </div>
        <p style="font-size: 1.1em">Hi,</p>
        <h2>New Complaint Appeal Received</h2>
        <p>Hi Admin,</p>
        <p>
             A new complaint appeal has been made by <strong>{{ $complainConversation->customerComplain->customer->firstName }} {{ $complainConversation->customerComplain->client->lastName }}</strong>.
        </p>
        <p>
            {!! str_replace('/upload', asset('upload'), strip_tags($complainConversation->reply_message, '<img>')) !!}
        </p>
        <p style="font-size: 0.9em;">Regards,<br />Your Brand</p>
        <hr style="border: none; border-top: 1px solid #eee" />
        <div style="float: right; padding: 8px 0; color: #aaa; font-size: 0.8em; line-height: 1; font-weight: 300">
            <p>Your Brand Inc</p>
            <p>1600 Amphitheatre Parkway</p>
            <p>California</p>
        </div>
    </div>
</div>