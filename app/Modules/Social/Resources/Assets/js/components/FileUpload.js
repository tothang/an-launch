import React from 'react';

const FileUpload = ({setFile, label}) => {

    const onChange = (e) => {
        setFile(e.target.files[0])
    }

    return (
        <div className="form-group">
            <label htmlFor={label}>{label + ':'}</label>
            <input type="file" className="my-2 form-control" onChange={onChange}/>
        </div>
    )
}

export default FileUpload
