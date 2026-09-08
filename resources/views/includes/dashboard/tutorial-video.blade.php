{{-- Floating "Watch Tutorial" launcher + video popup.
     Self-contained: own styles/scripts, no dependency on the page's modal
     helpers, so it can be included from any dashboard layout. --}}

<style>
	.tutorial-fab {
		position: fixed;
		/* Sits above the existing chat launcher in the bottom-right corner,
		   rather than on top of it. */
		right: 24px;
		bottom: 100px;
		z-index: 9998;
		display: flex;
		align-items: center;
		gap: 10px;
		padding: 12px 20px 12px 14px;
		border: 0;
		border-radius: 50px;
		background: #683D81;
		color: #fff;
		font-size: 15px;
		font-weight: 600;
		line-height: 1;
		cursor: pointer;
		box-shadow: 0 6px 20px rgba(104, 61, 129, .35);
		transition: transform .2s ease, box-shadow .2s ease;
	}
	.tutorial-fab:hover {
		transform: translateY(-2px);
		box-shadow: 0 10px 26px rgba(104, 61, 129, .45);
	}
	.tutorial-fab svg { flex: 0 0 auto; }

	.tutorial-modal {
		display: none;
		position: fixed;
		inset: 0;
		z-index: 9999;
		align-items: center;
		justify-content: center;
		padding: 20px;
		background: rgba(0, 0, 0, .7);
	}
	.tutorial-modal.is-open { display: flex; }

	.tutorial-modal__content {
		position: relative;
		width: 100%;
		max-width: 900px;
		background: #000;
		border-radius: 12px;
		overflow: hidden;
		box-shadow: 0 20px 60px rgba(0, 0, 0, .5);
	}
	.tutorial-modal__content video {
		display: block;
		width: 100%;
		max-height: 80vh;
		background: #000;
	}
	.tutorial-modal__close {
		position: absolute;
		top: 10px;
		right: 10px;
		width: 36px;
		height: 36px;
		display: flex;
		align-items: center;
		justify-content: center;
		border: 0;
		border-radius: 50%;
		background: rgba(0, 0, 0, .6);
		color: #fff;
		font-size: 22px;
		line-height: 1;
		cursor: pointer;
	}
	.tutorial-modal__close:hover { background: rgba(0, 0, 0, .85); }

	/* On small screens the label would crowd the footer tabs, so show the
	   icon only. */
	@media (max-width: 767px) {
		.tutorial-fab {
			right: 16px;
			bottom: 150px;
			padding: 14px;
			font-size: 0;
			gap: 0;
		}
	}
</style>

<button type="button" class="tutorial-fab" onclick="openTutorialVideo()" aria-label="Watch tutorial video">
	<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
		<circle cx="12" cy="12" r="11" stroke="#fff" stroke-width="1.8"/>
		<path d="M10 8.5L16 12L10 15.5V8.5Z" fill="#fff"/>
	</svg>
	Watch Tutorial
</button>

<div id="tutorialVideoModal" class="tutorial-modal" onclick="if(event.target===this){closeTutorialVideo();}">
	<div class="tutorial-modal__content">
		<button type="button" class="tutorial-modal__close" onclick="closeTutorialVideo()" aria-label="Close">&times;</button>
		{{-- preload="none" keeps the (large) file off the initial page load;
		     it only downloads once the user actually opens the popup. --}}
		<video id="tutorialVideoPlayer" controls controlsList="nodownload" preload="none">
			<source src="{{ asset('assets/videos/tutorial-video.mp4') }}" type="video/mp4">
			Your browser does not support the video tag.
		</video>
	</div>
</div>

<script>
function openTutorialVideo() {
	document.getElementById('tutorialVideoModal').classList.add('is-open');
	document.body.style.overflow = 'hidden';
}
function closeTutorialVideo() {
	var player = document.getElementById('tutorialVideoPlayer');
	if (player) { player.pause(); }
	document.getElementById('tutorialVideoModal').classList.remove('is-open');
	document.body.style.overflow = '';
}
document.addEventListener('keydown', function (e) {
	if (e.key === 'Escape') { closeTutorialVideo(); }
});
</script>
