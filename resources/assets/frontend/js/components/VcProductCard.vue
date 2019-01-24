<template>
    <div class="vc-card">
        <header class="vc-card-header">
            <div class="extras" v-if="is_new === 1">
                <img :src="app.basePath+'img/new.png'" alt="new" class="game-badge">
            </div>
            <img class="header-image img-fluid" :alt="name" :src="bg_image">
            <div class="descript">
                <h2 class="ng-binding">{{ name }}</h2>
                <p class="ng-binding">{{ description }}</p>
            </div>
        </header>
        <main class="vc-card-body">
            <slot name="card-body"></slot>
        </main>
        <footer class="vc-card-footer">
            <slot name="card-footer"></slot>
        </footer>
    </div>
</template>

<script>
export default {
    props: ['bg_image', 'is_new', 'name', 'title', 'description'],
    mounted () {
        
    }
}
</script>

<style scoped>

    input[type=radio] {
		margin: 0;
    	margin-right: 10px;
	}

    .vc-card {
		background: #efefef;
	    border-radius: 5px;
	    padding: 15px;
	    margin-bottom: 30px;
	    position: relative;
	}
    
    .vc-card-header {
		position: relative;
	}

    .vc-card-header .header-image { 
		width: 100%;
	}

	.vc-card-header:hover .descript {
	    opacity: 1;
	}

	.vc-card-header .descript {
	    position: absolute;
	    left: 0;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    background-color: rgba(239,239,239,.95);
	    z-index: 2;
	    opacity: 0;
	    -webkit-transition: opacity .3s ease-in-out;
	    transition: opacity .3s ease-in-out;
	    padding: 20px;
	    text-align: center;
	    color: #666;
	}

    .vc-card-header .extras img {
		position: absolute;
		top: -15px;
	    left: -5px;
	    z-index: 4;
	}

    .vc-card-body .amount {
		background: linear-gradient(87.71deg, #1DB2E0 0%, #6AD1ED 50.77%, #1DB2E0 100%);
	    height: 46px;
	    color: #FFFFFF;
	    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	    font-size: 15px;
	    font-weight: bold;
	    line-height: 46px;
	    text-align: center;
	    box-shadow: 0px -6px 5px -3px rgba(0,0,0,0.3);
	    position: relative;
	}

    .vc-card-body .jackpot-table {
		background: #0f546d;
	    color: #fff;
	    padding: 10px;
	    font-size: 13px;
	    font-weight: 700;
	}

	.vc-card-body .jackpot-table a.demo {
		display: block;
	    border: 2px solid rgba(255,255,255,.2);
	    border-radius: 5px;
	    color: #fff;
	    font-weight: 700;
	    -webkit-transition: border .3s ease-in-out;
	    transition: border .3s ease-in-out;
	    font-size: 13px;
    	margin: 10px 0 10px 0;
	}

	.vc-card-body .jackpot-table a.description {
		cursor: pointer;
    	color: #fff;
    	margin: 10px 0 10px 0;
	}

	.vc-card-body .jackpot-table a.demo:hover {
		border: 2px solid #fff;
	}

    .vc-card-body .btn {
        padding: 0;
    }

    .vc-card-footer label {
		padding: 3px 10px;
	    margin: 0;
	    width: 100%;
	    cursor: pointer;
	}

	.vc-card-footer form .row {
		color: #666;
	    background: rgba(255,255,255,.3);
	    border-bottom: 1px solid #eee;
	    font-size: 15px;
	    cursor: pointer;
	}
</style>
