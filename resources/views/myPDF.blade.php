<!DOCTYPE html>
<html>
<head>
    <title>Adp - directdata</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
        }

        td, th {
            /* border: 1px solid #dddddd; */
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <img src="{{ asset("storage/business/$business->logo") }}" alt="" style="height: 80px; width: 250px">
            </td>
            <td style="text-align: right">
                <img src="{{ asset("assets/images/Screenshot_1.png") }}" alt="" style="height: 74px; width: 189px: floar:right;">
            </td>
        </tr>
        <tr>
            <td style="width: 45%">
                {{-- <br> --}}
                <h3><u> LISTING INFORMATION</u></h3>
                <address>
                    {{$business->name}} <br>
                    {{$business->address}} <br>
                    {{$business->address2}}, {{$business->city}}, {{$business->state}}, {{$business->zipcode}}. <br>
                    Main Phone: {{$business->phone}} <br>
                    Website (URL): <a href="{{$business->url}}">{{$business->url}}</a>  <br>
                    Email: {{$business->email}} <br>
                    Social Sites: <br>
                    ID:
                </address>
            </td>
            <td style="text-align: right">
                <img src="{{ asset("assets/images/location.png") }}" alt="location" style="height: 170px; width:380px">
            </td>
        </tr>
    </table>
    {{-- <br> --}}
    <h3><u>YELLOW PAGES HEADING(S)</u></h3>
    <hr>
    @foreach ($business->headings as $heading)
    <table>
        <tr>
            <td colspan="2" style="font-size:20px;">
                {{$heading->name}}
            </td>
            <td colspan="2" style="text-align: right">
                <div>
                    <img src="{{ ($heading->pivot->image)? asset("storage/headings/".$heading->pivot->image) : asset("storage/headings/".$heading->image) }}" alt="Heading Image" style="height: 120px; width:320px">
                </div>
            </td>
        </tr>
        @if (!empty(json_decode($heading->pivot->offered_keywords,true)))
        <tr>
            <td colspan="4"><b> <u>Offered Keywords</u></b></td>
        </tr>
        <tr>
            @foreach (collect(json_decode($heading->pivot->offered_keywords,true))->pluck('name') as $key=>$name)
            <td style="font-size: 11px">{{$name}}</td>
            @if (($key+1)%4 === 0)
                </tr><tr>
            @endif
            @endforeach
        </tr>
        @endif

        @if (!empty(json_decode($heading->pivot->additional_keywords,true)))
        <tr>
            <td colspan="5"><b> <u>Additional Keywords</u></b></td>
        </tr>
        <tr>
            @foreach (collect(json_decode($heading->pivot->additional_keywords,true))->pluck('name') as $key=>$name)

            <td style="font-size: 11px">{{$name}}</td>
            @if (($key+1)%4 === 0)
            </tr><tr>
            @endif
            @endforeach
        </tr>
        @endif
    </table>
    <hr>
    @endforeach
</body>
