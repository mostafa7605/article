<?php
namespace App\Imports;

use App\Models\Article;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\ImportData;
use App\Models\ImportDataFields;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Crypt;

class DataImport implements ToCollection, WithStartRow, WithChunkReading
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) 
        {
        
            $emails=explode(',', $row[1]);
            $phones=explode(',', $row[2]);
        
                $data=ImportData::create([
                'name' =>  Crypt::encryptString($row[0]),
                'ig_username' =>  Crypt::encryptString($row[3]),
                'twitter_username' => Crypt::encryptString($row[4]),
                'facebook_username' =>  Crypt::encryptString($row[5])
            ]);
            foreach($emails as $email)
            {
                if(strlen($email)!=0)
                {
                    ImportDataFields::create([
                       'import_data_id' =>$data->id,
                        'fields' =>  Crypt::encryptString($email),
                        'type'=>'email'
                    ]);
                    
                }
               
            }


            foreach($phones as $phone)
            {
             
                if(strlen($phone)!=0)
                {
                    $phone=str_replace('"', '', $phone);
      
                    ImportDataFields::create([
                       'import_data_id' =>$data->id,
                        'fields' =>  Crypt::encryptString($phone),
                        'type'=>'phone'
                    ]);
                }
               
            }
            $invited_users= \DB::table('tagged_people')->whereNull('user_id')->where('tagged_name',$row[3])->orWhere('tagged_name',$row[3])->orWhere('tagged_name',$row[4])->get();
if(strlen($emails[0])!=0 && count($invited_users)!=0)
{
foreach($invited_users as $invited_user)
{
    $article=Article::where('id',$invited_user->article_id)->first();
    if($article->approved==1)
    {
        $email_user=$emails[0];

        $data=['article_id'=>$article->id];
        \Mail::send('emails.invitation', $data,function ($message) use ($email_user) {
        $message->to($email_user)->subject('R-write Invitation');
        $message->from('info@rwrite.com', 'R-write Invitation');
        });
    }
}
}


if(strlen($phones[0])!=0 && count($invited_users)!=0)
{
foreach($invited_users as $invited_user)
{
    $article=Article::where('id',$invited_user->article_id)->first();
    if($article->approved==1)
    {
        $email=$emails[0];
        $url='https://rwrite.msol.dev/article_view/'.$article->id;

        $sms_message="You have been invited to Rwrite platform. \n" .$url;
        // SMS 
        send_sms($sms_message,$phones[0]);
        
    }
}
}
           
        }
    }

    public function startRow(): int
    {
        return 2;
    }
  
    public function chunkSize(): int
    {
        return 1000;
    }
}