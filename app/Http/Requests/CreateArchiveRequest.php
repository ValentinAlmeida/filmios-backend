<?php

namespace App\Http\Requests;

use App\Infra\FileSystem\LaravelStorage\UTF8Content;

class CreateArchiveRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "file_path" => [
                'required',
                'file',
                'mimes:pdf',
                'max:11264'
            ]
        ];
    }

    public function getArchiveContent()
    {
        $this->has('file_path') ? $caminho = UTF8Content::make($this->file('file_path')->getContent()) : $caminho = null;

        return $caminho;
    }
}
