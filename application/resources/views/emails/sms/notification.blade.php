Upcoming Bill ${{ number_format($bill['amount'], 2) }} {{ $bill->company['name'] }} @if($bill->company['nickname'])(Nickname: {{ $bill->company['nickname'] }}) @endif is due on {{ date('F d, Y', strtotime($bill['due'])) }}