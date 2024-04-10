'use strict';

/**
 * This class helps to provide convenient sorting of the data in the table
 * by changing the URL parameters and updating the visual representation accordingly.
 */
class SortableTable {
    constructor() {
        this.sortFields = document.querySelectorAll('.sort-field');
        this.searchFields = document.querySelectorAll('#table-search');
        this.urlParams = this.getUrlParams();

        this.initSortFields();
        this.initSearch();
        this.stateSortTable();
    }

    /**
     * Setting event handlers for sort fields on page load.
     */
    initSortFields() {
        this.sortFields.forEach(field => {
            field.addEventListener('click', evt => this.toggleSort(evt, field));
        });
    }

    initSearch() {
        this.searchFields.forEach(field => {
            field.addEventListener('keyup', evt => {
                if (evt.key === 'Enter' || evt.keyCode === 13 || !field.value) {
                    this.urlParams.keywords = field.value;

                    this.updateUrl();
                }
            });
        });
    }

    toggleSort(evt, field) {
        let arrowElement = field.querySelector('.sort-arrows');
        let dataSort = arrowElement.getAttribute('data-sort');
        let fontawesomeIcon = arrowElement.querySelector('i');

        this.updateUrlParams(dataSort);

        let newArrowClass = this.getArrowClassBasedOnType(this.urlParams.type);

        this.clearSortArrowsExcept();

        if (dataSort === this.urlParams.orderBy) {
            this.addedNewArrowClass(fontawesomeIcon, newArrowClass);
        }

        this.updateUrl();
    }

    /**
     * Displaying the visual state of the sort arrows based on URL parameters, when the page is loaded.
     *
     * @returns {boolean}
     */
    stateSortTable() {
        if (!this.urlParams.orderBy && !this.urlParams.type && !this.urlParams.keywords) {
            return false;
        }

        this.sortFields.forEach(field => {
            let arrowElement = field.querySelector('.sort-arrows');
            let dataSort = arrowElement.getAttribute('data-sort');
            let fontawesomeIcon = arrowElement.querySelector('i');

            let newArrowClass = this.getArrowClassBasedOnType(this.urlParams.type);

            this.clearSortArrowsExcept();

            if (dataSort === this.urlParams.orderBy) {
                this.addedNewArrowClass(fontawesomeIcon, newArrowClass);
            }
        });

        this.searchFields.forEach(field => {
            field.value = this.urlParams.keywords;
        });
    }

    clearSortArrowsExcept() {
        this.sortFields.forEach(elem => {
            let elemDataSort = elem.querySelector('.sort-arrows').getAttribute('data-sort');

            if (elemDataSort !== this.urlParams.orderBy) {
                let icon = elem.querySelector('i');

                if (icon) {
                    icon.classList.remove('fa-sort-up', 'fa-sort-down');
                    icon.classList.add('fa-sort');
                }
            }
        });
    }

    /**
     *
     * @param fontawesomeIcon
     * @param newArrowClass
     */
    addedNewArrowClass(fontawesomeIcon, newArrowClass) {
        fontawesomeIcon.classList.remove('fa-sort', 'fa-sort-up', 'fa-sort-down');
        fontawesomeIcon.classList.add(newArrowClass);
    }

    /**
     *
     * @param currentType
     * @returns {string}
     */
    getArrowClassBasedOnType(currentType) {
        return currentType === 'desc' ? 'fa-sort-up' : 'fa-sort-down';
    }

    /**
     * Processing the current URL, returning its parameters.
     *
     * @returns {{orderBy: string, type: string}}
     */
    getUrlParams() {
        let currentUrl = new URL(window.location.href);

        return {
            keywords: currentUrl.searchParams.get('keywords'),
            orderBy: currentUrl.searchParams.get('orderBy'),
            type: currentUrl.searchParams.get('type')
        };
    }

    /**
     * Changing the URL to reflect the sorting changes.
     */
    updateUrl() {
        let currentUrl = new URL(window.location.href);

        if (this.urlParams.keywords) {
            currentUrl.searchParams.set('keywords', this.urlParams.keywords);
        } else {
            currentUrl.searchParams.delete('keywords');
        }

        if (this.urlParams.orderBy) {
            currentUrl.searchParams.set('orderBy', this.urlParams.orderBy);
        }

        if (this.urlParams.type) {
            currentUrl.searchParams.set('type', this.urlParams.type);
        }

        window.location.href = currentUrl.toString();
    }

    /**
     * Change URL parameters.
     *
     * @param dataSort
     */
    updateUrlParams(dataSort) {
        if (this.urlParams.orderBy === dataSort) {
            this.urlParams.type = this.urlParams.type === 'asc' ? 'desc' : 'asc';
        } else {
            this.urlParams.orderBy = dataSort;
            this.urlParams.type = 'asc';
        }
    }
}
