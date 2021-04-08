import React from 'react';

const PageNav = ({pageCount, setPage, page}) => {
    const pages = []

    for (let i = 0; i < pageCount; i++){
        pages.push(i + 1)
    }

    return (

        <div className="text-center mt-3">
            <nav>
                <ul className="pagination justify-content-center">
                    {pages.map((pageNumber, index) =>
                        <li key={index} className={`page-item ${pageNumber == page ? 'active' : ''}`}>
                            <a onClick={() => setPage(pageNumber)} className="page-link">{pageNumber}</a>
                        </li>
                    )}
                </ul>
            </nav>
        </div>
    )
}

export default PageNav;
