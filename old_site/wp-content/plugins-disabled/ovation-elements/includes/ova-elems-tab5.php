<div id="oe-block-tab">
    <div class="search-wrapper-outer">
        <div class="search-container">
            <input type="text" id="search-box" class="form-control" placeholder="Search products...">
            <button id="search-button" class="btn btn-secondary">Search</button>
        </div>
        <select id="api-response-dropdown" class="form-control">
            <option value="">Themes Categories</option>
        </select>
    </div>
    <div id="product-cards" class="row"></div>
    <button id="load-more" class="btn btn-primary" style="display:none;">Load More</button>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const apiEndpoint = '<?php echo esc_url(plugin_dir_url(__FILE__) . 'fetch-api.php'); ?>';
        let endCursor = null;
        let searchQuery = '';
        let selectedCollection = '';
        let debounceTimeout = null; 

        function fetchCollections() {
            return fetch(apiEndpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'getCollections' })
            })
                .then(response => response.json())
                .then(data => populateDropdown(data))
                .catch(error => console.error('Error fetching collections:', error));
        }

        function fetchApiData(afterCursor = null, append = false) {
            return fetch(apiEndpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'getProducts',
                    collectionHandle: selectedCollection,
                    productHandle: searchQuery,
                    paginationParams: { first: 12, afterCursor: afterCursor, reverse: true }
                })
            })
                .then(response => response.json())
                .then(data => {
                    displayData(data, append);
                    endCursor = data.data.pageInfo.endCursor;
                    document.getElementById('load-more').style.display = data.data.pageInfo.hasNextPage ? 'block' : 'none';
                })
                .catch(error => console.error('Error fetching products:', error));
        }


        function populateDropdown(data) {
            const dropdown = document.getElementById('api-response-dropdown');
            dropdown.innerHTML = '<option value="">Themes Categories</option>';

            if (data && data.data && Array.isArray(data.data)) {
                data.data.forEach(collection => {
                    const option = document.createElement('option');
                    option.value = collection.handle;
                    option.textContent = collection.title;
                    dropdown.appendChild(option);
                });
            } else {
                console.error('Data format is incorrect:', data);
            }
        }

        function displayData(data, append = false) {
            const productCards = document.getElementById('product-cards');
            if (!append) productCards.innerHTML = '';

            if (data && data.data && Array.isArray(data.data.products)) {
                let filteredProducts = data.data.products;

                if (searchQuery) {
                    filteredProducts = filteredProducts.filter(product => product.node.inCollection === true);
                }

                filteredProducts.forEach(product => {
                    const item = product.node;
                    const imageSrc = item.images.edges[0]?.node.src || 'default-image.jpg';
                    const price = item.variants.edges[0]?.node.price || 'N/A';
                    const demoLink = item.metafield?.value || '#';  

                    const colElement = document.createElement('div');
                    colElement.classList.add('col-12', 'col-md-6', 'col-lg-3', 'mb-3');
                    colElement.innerHTML = `
                        <div class="card">
                            <div class="card-img-wrap">
                                <img src="${imageSrc}" class="card-img-top" alt="${item.title}">
                                <div class="ov-button-wrapper">
                                <div class= "ov-box">
                                    <a href="${item.onlineStoreUrl}" class="btn btn-primary" target="_blank">Buy Now</a>
                                    <a href="${demoLink}" class="btn btn-primary demo" target="_blank" style="margin-left: 10px;">Demo</a>
                                </div>                            
                                <div class="card-text"><span>Price: </span> ${price}</div></div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">${item.title}</h5>
                            </div>
                        </div>
                    `;
                    productCards.appendChild(colElement);
                });
            } else {
                console.error('Data format is incorrect:', data);
            }
        }

        // search function
        function debouncedSearch() {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function () {
                endCursor = null;
                fetchApiData();
            }, 1000); // 1 
        }

        // Event listener for search input
        document.getElementById('search-box').addEventListener('input', function () {
            searchQuery = this.value.trim();
            debouncedSearch();
        });

        document.getElementById('load-more').addEventListener('click', function () {
            if (endCursor) fetchApiData(endCursor, true);
        });

        document.getElementById('api-response-dropdown').addEventListener('change', function () {
            selectedCollection = this.value;
            endCursor = null;
            fetchApiData();
        });

        fetchCollections(); 
        fetchApiData(); 
    });
</script>