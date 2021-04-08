import React from 'react';

const Loader = () => {
    return (
        <div className="col-12 text-center mt-4">
            <div className="spinner-border text-secondary" role="status">
                <span className="sr-only">Loading...</span>
            </div>
        </div>
    )
}

export default Loader
