<!DOCTYPE html>
<html>

<head>
    <title>Hakiki-email</title>
</head>

<body>
<h1>{{ $details['title'] }}</h1>
<p>{{ $details['body'] }}</p>
<br />
<a href="{{ route('email.verification',$details['token']) }}" class="">Bonyeza hapa kuakiki barua pepe</a>
<p>Ahsante <br /> @env ('APP_NAME') @endenv</p>
</body>

</html>
