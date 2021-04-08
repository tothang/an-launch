import React from 'react'

const Pagination = ({ page, setPage, pages }) => {

    const pageButtons = []

    for(let i = 1; i <= pages; i++) {
        pageButtons.push(
            <li onClick={() => setPage(i - 1)}
                 key={i}
                 className={page + 1 === i ? 'active' : ''}
            >
                <a>{i}</a>
            </li>
        )
    }

    return (
        <ul className="pagination">
            <li onClick={() => setPage(0)}
                className={page === 0 ? 'disabled' : ''}
            >
                <a>First</a>
            </li>
            <li onClick={() => page > 0 && setPage(page - 1)}
                className={page > 0 ? '' : 'disabled'}
            >
                <a>Previous</a>
            </li>
            {pageButtons}
            <li onClick={() => (pages > (page + 1)) && setPage(page + 1)}
                className={page + 1 < pages ? '' : 'disabled'}
            >
                <a>Next</a>
            </li>
            <li onClick={() => setPage(pages - 1)}
                className={page === pages - 1 ? 'disabled' : ''}
            >
                <a>Last</a>
            </li>
        </ul>
    )
}
export default Pagination
