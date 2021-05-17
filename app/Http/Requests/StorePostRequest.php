<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class StorePostRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

//        protected function prepareForValidation()
//        {
//            $this->merge([
//                'need_to_have_default_value' => $this->need_to_have_default_value ?? 1 // Replace $defaultValue with value that you want to set as default
//            ]);
//        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'title' => 'required',
                'task' => 'required',
                'is_task_done' => 'required',
                'deadline' => 'required',
            ];
        }
    }
