window.addEventListener('load', 
    () => {
        const uploadForm = document.getElementById('fileUploader');
        const uploadProgress = uploadForm.querySelector('progress');
        const uploadProgressLabel = uploadForm.querySelector('span');

        uploadForm.addEventListener('submit', 
            async (sender) => {
                sender.preventDefault();

                var formdata = new FormData(sender.target);

                let xmlHttpRequest = new XMLHttpRequest();
                xmlHttpRequest.upload.addEventListener('progress', 
                    (event) =>{
                        uploadProgress.value = Math.round((event.loaded / event.total) * 100);
                        uploadProgressLabel.innerText = event.loaded + ' de ' + event.total;
                    }
                );
                xmlHttpRequest.onreadystatechange = function(e){
                    if(this.readyState != 4)
                        return;
                    if(this.status != 201)
                        return alert(this.status);
                    window.location = `/public/download.php?fileId=${this.responseText}`;
                }

                xmlHttpRequest.open(sender.target.attributes.method.value, sender.target.attributes.action.value);
                xmlHttpRequest.send(formdata);
            }
        );
    }
);