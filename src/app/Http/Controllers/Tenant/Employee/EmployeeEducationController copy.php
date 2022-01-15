<?php

namespace App\Http\Controllers\Tenant\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\Employee\EmployeeEducationRequest;
use App\Models\Core\Auth\User;
use App\Models\Tenant\Employee\UserEducation;
use App\Services\Tenant\Employee\EmployeeEducationService;

class EmployeeEducationController extends Controller
{
    public function __construct(EmployeeEducationService $service)
    {
        $this->service = $service;
    }

    public function index(User $employee)
    {
        return $employee->educations->sortBy(function (UserEducation $education) {
            return $education->id;
        });
    }

    public function store() {
        $this->service
            ->setAttributes(request()->all())
            ->basicValidations()
            ->saveEmployeeEducation();

        return updated_responses('employee_educations');
    }

    // public function store(User $employee, EmployeeEducationRequest $request)
    // {
    //     dd($request);
    //     $employee->educations()->save(new UserEducation([
    //         'key' => 'employee_educations',
    //         'value' => json_encode($request->only('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark'))
    //     ]));

    //     return created_responses('employee_educations');
    // }

    public function show(User $employee, UserEducation $education)
    {
        return $education;
    }
    
    public function update(User $employee, UserEducation $education, EmployeeEducationRequest $request)
    {
        dd($request->file());
        
        

        // if(count($request->get('files[]')) > 0) {
            
        // //     for ($i=0; $i<count($request->attachments); $i++) {
        // //         $education->attachments()->save(new File([
        // //             'path' => $this->storeFile($request->attachments[$i], 'education'),
        // //             'type' => 'employee-education',
        // //         ]));
        // //     }
        //     // dd($request->attachments);
        // foreach ($request->get('attachments[]') as $attachment) {
        //     $rooms = json_decode(json_encode($attachment));
        //     // dd($rooms);
        //     // $image = base64_decode(json_decode($rooms));
        //     $education->attachments()->save(new File([
        //         'path' => $this->storeFile($rooms, 'education'),
        //         'type' => 'employee-education',
        //     ]));
        // }
        //         $rooms = json_encode($attachment);
        //         // dd($rooms);

        //         // $image = base64_decode(json_decode($rooms)->dataURL);
                
        //         $education->attachments()->save(new File([
        //             'path' => $this->storeFile($attachment, 'education'),
        //             'type' => 'employee-education',
        //         ]));
        //     }
        // }

        // $this->service
        //     ->setAttributes($request->only('document_no', 'type', 'valid_from', 'valid_to', 'note'))
        //     ->validateEducation()
        //     ->setModel($employee)
        //     ->updateEducation();
        
        // $base64File = $request->get('attachments[]')['dataURL'];
        // $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

        // dd($fileData);

        // dd($request->hasFile('attachments[]'));
        // dd($request->get('attachments[]'));
        // foreach ($request->get('attachments[]') as $content) {
        //     dd($content);
        // }
        

        // if ($request->get('attachments') && count($request->get('attachments')) > 0) {
        //     dd($education->getAttribute('attachments'));

            // foreach ($this->getAttr('attachments') as $attachment) {
            //     dd($attachment);
            // }
            


        //     $base64File = $request->get('attachments[]')['dataURL'];
        //     $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

        //     $image = imagecreatefromstring($fileData);
        //     header('Content-type: image/png');
        //     // return imagejpeg($image);
            
        //     dd(imagejpeg($image));

        //     foreach ($request->get('attachments[]') as $attachment) {
        //         // $base64File = $attachment['dataURL'];
        //         // $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));

        //         // $image = imagecreatefromstring($fileData);
        //         // header('Content-type: image/png');
        //     // return imagejpeg($image);

        // //     //     dd($fileData);
        //         $education->attachments()->save(new File([
        //             'path' => $this->storeFile($attachment, 'education'),
        //             'type' => 'employee-education',
        //         ]));
        //     }
        // }
        // if ($this->getAttributes('attachments') && count($this->getAttr('attachments')) > 0) {
        //     foreach ($this->getAttr('attachments') as $attachment) {
        //         $this->leave->attachments()->save(new File([
        //             'path' => $this->storeFile($attachment, 'education'),
        //             'type' => 'employee-education',
        //         ]));
        //     }
        // }

        // dd('test');

        // $education->update([
        //     'value' => $request->only('education_level', 'education_field', 'educational_institution', 'educational_institution_detail', 'location', 'start_year', 'end_year', 'grade_point_average', 'achievement', 'remark')
        // ]);

        // return updated_responses('employee_educations');
    }

    public function destroy(User $employee, UserEducation $education)
    {
        $education->delete();

        return deleted_responses('employee_educations');
    }
}
