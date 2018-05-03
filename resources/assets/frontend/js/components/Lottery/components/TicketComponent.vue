<template>
	<div class="ticket-card">
		<header class="ticket-card-header">
			<div class="extras" v-if="scratch_card_theme.lot.new == 1">
				<img :src="app.basePath+'img/new.png'" alt="new" class="game-badge">
			</div>
			<img class="header-image img-fluid" :alt="scratch_card_theme.nome" :src="src(scratch_card_theme.img_card_url)">
			<div class="descript">
                <h2 class="ng-binding">{{ scratch_card_theme.nome }}</h2>
                <p class="ng-binding">{{ scratch_card_theme.texto_raspadinha }}</p>
            </div>
		</header>
		<div class="ticket-card-body">
			<div class="amount">
				{{ scratch_card_theme.texto_index }}
			</div>
			<div class="jackpot-table">
				<div class="row vcenter">
					<div class="col-lg-8 col-12 col-md-8 col-sm-12">
						<a :data-id="scratch_card_theme.id" href="#" @click.prevent="handleJackpotTable($event)" class="btn description">
							<i class="fa fa-money" aria-hidden="true"></i>
							&nbsp;
							Tabela de Premios
						</a>
					</div>
				</div>
			</div>
		</div>

		<footer class="ticket-card-footer">
			
		</footer>
	</div>
</template>

<script>
	export default {

	}
</script>

<style scoped>
	
</style>