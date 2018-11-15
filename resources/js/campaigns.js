const NUM_CAMPAIGNS_PER_PAGE = 10;

class Campaigns {

    get campaignsHtml(){
        return document.querySelector('.infinite-scroll').querySelector('.row').innerHTML;
    }

    set campaignsHtml(value){
        return document.querySelector('.infinite-scroll').querySelector('.row').innerHTML = value;
    }

    get campaigns() {
        return this.campaigns_;
    }

    set campaigns(campaigns) {
        this.campaigns_ = campaigns;
        this.updateView();
    }

    get loader(){
        return document.querySelector('.loader');
    }

    get infiniteScroll() {
        return document.querySelector('.campaigns-list-wrapper-inner');
    }

    constructor() {
        this.campaigns_ = [];
        document.querySelector('.category-select').onchange = event => this.filterCategory(event);
        document.querySelector('.name-input').oninput = event => this.filterName(event);
        // axios.get('/campaigns').then(result => {
        axios.get('/campaigns').then(result => {
            this.filteredCampaigns = this.sourceCampaigns = result.data.data;
            this.campaigns = this.filteredCampaigns.slice(0, NUM_CAMPAIGNS_PER_PAGE);
            window.updateInfiniteScrollWraperHeight();
        });
        this.infiniteScroll.addEventListener('scroll', () => {
            if (this.infiniteScroll.scrollTop + this.infiniteScroll.clientHeight >= this.infiniteScroll.scrollHeight) {
                this.loadMore();
            }
        });
        this.filter = {
            categoryId: -1,
            name: ''
        }
    }

    filterCategory(e) {
        this.filter.categoryId = e.target.value;
        this.updateFilter();
    }

    filterName(e) {
        this.filter.name = e.target.value;
        this.updateFilter();
    }

    updateFilter() {
        this.infiniteScroll.scrollTo(0,0);
        this.filteredCampaigns = this.sourceCampaigns.filter(campaign => {
            return (this.filter.categoryId == -1 || campaign.category_id == this.filter.categoryId) && campaign.name.toLowerCase().indexOf(this.filter.name.toLowerCase()) != -1;
        });
        this.campaigns = this.filteredCampaigns.slice(0, NUM_CAMPAIGNS_PER_PAGE);
    }

    loadMore(){
        if(this.campaigns.length >= this.filteredCampaigns.length){
            return;
        }
        this.loader.classList.add('show');
        setTimeout(() => {
            this.campaigns.push(...this.filteredCampaigns.slice(this.campaigns.length, this.campaigns.length + NUM_CAMPAIGNS_PER_PAGE));
            this.loader.classList.remove('show');
            this.updateView();
        }, 1000);
    }

    strLimit(str, limit) {
        if(!str){
            return "";
        }
        if (str.length <= limit) {
            return str;
        }
        return str.substr(0, limit - 3) + "...";
    }

    updateView() {
        this.campaignsHtml = this.campaignsView(this.campaigns);
    }

    campaignsView(campaigns) {
        return campaigns.map(campaign => this.campaignView(campaign)).join('');
    }

    campaignView(campaign) {
        return `
            <div class="col-xl-3 col-sm-6 campaign-col">
                <a href="/campaigns/${campaign.id}" class="ps-card">
                    <div class="ps-card-image-container fade">
                <span class="ps-card-icon">
                    <img style="${!campaign.category_icon ? 'display: none;' : ''}" src="data:image/png;base64,${campaign.category_icon}">
                </span>
                        <div class="ps-card-image" style="background-image: url(${campaign.featured_image_url});"></div>
                    </div>

                    <div class="ps-card-description">
                        <h4>
                            ${this.strLimit(campaign.name, 15)}
                        </h4>
                        <p class="ps-card-excerpt">
                            ${this.strLimit(campaign.target_audience, 13)}
                        </p>
                    </div>
                </a>
            </div>
        `;
    }
}

window.addEventListener('load', () => {
    if(document.querySelector('.category-select')) {
        window.campaigns = new Campaigns();
    }
});
