@php

    $random = str_random();
    $uploadTemplateId = "template-upload-" . $random;
    $downloadTemplateId = "template-download-" . $random;
    $singlePreviewId = "single-preview-" . $random;
@endphp

<!-- The file upload form used as target for the file upload widget -->
<div class="fileupload"

     data-upload-template-id="{{$uploadTemplateId}}"
     data-download-template-id="{{$downloadTemplateId}}"
     data-single-preview-id="{{$singlePreviewId}}"

     data-sample="5"
     data-url="{{$config['url']}}"
     data-is-single="{{!$multiple}}"

     @if(isset($config) && is_array($config))
         @foreach($config as $key=> $value)
            data-config-{{kebab_case($key)}}="{!! $value !!}"
         @endforeach
     @endif

     @if(isset($data) && is_array($data))
        @foreach($data as $key => $value)
            data-form-{{kebab_case($key)}}="{!! $value !!}"
        @endforeach
    @endif
>

    @csrf

    @if($multiple)
        <div class="multiple-image-upload">
            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
            <div class="row fileupload-buttonbar">
                <div class="col-lg-7">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="{{$config['paramName']}}" @if($multiple) multiple @endif>
                </span>
                    <button type="submit" class="btn btn-primary start">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start upload</span>
                    </button>
                    <button type="reset" class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel upload</span>
                    </button>
                    <button type="button" class="btn btn-danger delete">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" class="toggle">
                    <!-- The global file processing state -->
                    <span class="fileupload-process"></span>
                </div>
                <!-- The global progress state -->
                <div class="col-lg-5 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                    <!-- The extended global progress state -->
                    <div class="progress-extended">&nbsp;</div>
                </div>
            </div>
            <!-- The table listing the files available for upload/download -->
            <table role="presentation" class="table table-striped">
                <tbody class="files"></tbody>
            </table>


            <!-- The template to display files available for upload -->
            <script id="{{$uploadTemplateId}}" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}





            </script>
            <!-- The template to display files available for download -->
            <script id="{{$downloadTemplateId}}" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}





            </script>
        </div>
    @else
    <!-- The table listing the files available for upload/download -->
        <div class="single-image-upload">
            <div>
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
                <img class="img-preview" id="{{$singlePreviewId}}" src=""/>
            </div>
            <table role="presentation" class="table table-striped">
                <div class="files"></div>
            </table>
            <div class="row fileupload-buttonbar">
                <div class="col-lg-6">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Upload</span>
                    <input type="file" name="{{$config['paramName']}}" @if($multiple) multiple @endif>
                </span>

                </div>
                <!-- The global progress state -->
                <div class="col-lg-6 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                </div>
            </div>
            <script id="{{$uploadTemplateId}}" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <img style="display:none" src="{%=file.url%}"/>
    {% } %}




            </script>
            <script id="{{$downloadTemplateId}}" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
        <img style="display:none" src="{%=file.url%}"/>
        {% } %}



            </script>
        </div>
    @endif
</div>
