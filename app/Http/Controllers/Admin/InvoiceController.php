<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Setting;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Support\Facades\View;
use TCPDF;

class InvoiceController extends Controller
{
    public function generatePDF($id)
    {


    // إنشاء كائن TCPDF
    $pdf = new TCPDF();
    $pdf->setPrintHeader(false); // تعطيل الهيدر
    $pdf->setPrintFooter(false); // تعطيل التذييل
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->AddPage();
    $logoPath = asset('images/' . Setting::find(1)->photo) ; // تأكد من وجود الصورة
    // $logoPath = asset('images/' . Setting::find(1)->photo); // تأكد من وجود الصورة

    $pdf->Image($logoPath, 85, 10, 40); // 85: العرض، 10: الإحداثي Y، 40: الحجم
    $pdf->Ln(35);
    $pdf->setRTL(true);
    // تعيين خط يدعم العربية
     $pdf->SetFont('dejavusans', '', 12);

    // $pdf->SetFont('arial', '', 12);
    // تحميل محتوى HTML من العرض (view) مع البيانات


   $booking =Booking::find($id);

   if ($booking->installment == 1){
   $installment= 'دفعة اولي';

}elseif ($booking->installment == 2){

    $installment= 'دفعة ثانية';
}elseif ($booking->installment == 3){

     $installment= 'دفعة ثالثة';
}elseif ($booking->installment == 4){

  $installment= 'دفعة رابعة';
}elseif ($booking->installment == 5){

      $installment= 'دفعة خامسة';
 }elseif ($booking->installment == 6){

$installment= 'دفعة سادسة';
 }elseif ($booking->installment == 7){

$installment= 'دفعة سابعة';
     }

     if ($booking->type == 1){
        $type= 'أوفلاين';

     }elseif ($booking->type == 2){

         $type= 'أونلاين';
     }


   $html = '<!DOCTYPE html>
   <html lang="ar">

   <head>
       <meta charset="UTF-8">
       <title>فاتورة</title>
       <style>
           body {
               direction: rtl;
               text-align: right;
           }

           table {
               width: 100%;
               border-collapse: collapse;
               margin-top: 20px;
           }

           th, td {
               border: 1px solid #ffffff;
               padding: 10px;
               text-align: right;
           }

           h3, h4 {
               margin-top: 20px;
           }

           ol {
               margin-top: 20px;
               padding-right: 20px;
           }

           ol li {
               margin-bottom: 15px;
               line-height: 1.5;
           }

           ul {
               margin-top: 5px;
               padding-right: 30px;
           }

           ul li {
               margin-bottom: 10px;
           }
       </style>
   </head>

   <body>
       <h2>فاتورة رقم: #' .  $booking->id . '</h2>
       <p>التاريخ: ' .  \Carbon\Carbon::parse($booking->created_at)->format("Y-m-d") . '</p>

       <table   cellpadding="5">
           <thead>
               <tr style="background-color:#888;" >
                   <th>الطالب</th>
                   <th>الكورس</th>
                   <th>نوع الحجز</th>

                   <th>القسط</th>
                   <th>سعر الكورس</th>
                   <th>المبلغ المدفوع</th>
                   <th>المبلغ المتبقي</th>

               </tr>
           </thead>
           <tbody>
               <tr>
                   <td>' . $booking->customer->name . '</td>
                   <td>' . $booking->course->title_ar . '</td>

                   <td>' . $type . '</td>
                   <td>' . $installment . '</td>
                   <td>' . $booking->price . ' ج</td>
                   <td>' . $booking->total . ' ج</td>
                   <td>' . $booking->remaining . ' ج</td>

               </tr>
           </tbody>
       </table>


       <h4>الشروط والبنود:</h4>
       <ol>
           <li><strong>شروط الدفع:</strong>
               <ul>
                   <li>يتم دفع المبلغ كاملاً قبل بداية الدورة أو يمكن تقسيط المبلغ على عدد الدفعات المتفق عليها.</li>

               </ul>
           </li>
           <li><strong>شروط الإلغاء:</strong>
               <ul>

                   <li>لا يتم استرداد المبلغ بعد بدء الدورة إلا في حالة ظروف طارئة يتم الاتفاق عليها مع الأكاديمية.</li>
                </ul>
           </li>
           <li><strong>شروط الحضور:</strong>
               <ul>
                   <li>يجب على الطالب الالتزام بحضور جميع المحاضرات ومتابعة الدورة بشكل منتظم لضمان الحصول على الشهادة.</li>
                   <li>الحضور أونلاين أو أوفلاين حسب نوع الدورة المسجلة، ويجب على الطالب التواجد في الوقت المحدد للمحاضرة.</li>
               </ul>
           </li>
           <li><strong>شروط الشهادة:</strong>
               <ul>
                   <li>للحصول على الشهادة المعتمدة، يجب على الطالب إتمام الكورس بنجاح والحصول على نسبة حضور لا تقل عن 80% من المحاضرات.</li>
                   <li>لا يتم منح الشهادة إلا بعد إتمام كافة المشاريع العملية ونجاح الطالب في اختبارات الكورس.</li>
               </ul>
           </li>
           <li><strong>شروط إعادة الكورس:</strong>
               <ul>
                   <li>يمكن للطالب إعادة الكورس مجانًا في حال حدوث ظروف استثنائية منعه من إكمال الدورة (مثل المرض أو السفر) بعد التنسيق مع الأكاديمية.</li>
               </ul>
           </li>
           <li><strong>الحقوق الفكرية:</strong>
               <ul>
                   <li>جميع المواد التعليمية المقدمة في الدورة تعتبر ملكاً للأكاديمية ولا يجوز نشرها أو توزيعها دون إذن رسمي.</li>
               </ul>
           </li>
       </ol>
   </body>

   </html>';





    // إدراج HTML مع دعم RTL
    $pdf->WriteHTML($html  , true, 0, true, 0);

    // تصدير PDF
    return response()->streamDownload(function () use ($pdf) {
        $pdf->Output('invoice.pdf', 'I');
    }, 'invoice.pdf');
    }
}
