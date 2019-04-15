<?php  $test1 =  DB::table('conversations')
->where('conversations.user_one', Auth::user()->id)
->where('conversations.con_status', 0)
->count();
$test2 =  DB::table('conversations')
->where('conversations.user_two', Auth::user()->id)
->where('conversations.con_status', 0)
->count();
echo $test1 + $test2;
//return array_merge($test1->toArray(),$test2->toArray()) ;