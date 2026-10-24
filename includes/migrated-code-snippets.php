<?php
/**
 * Migrated Code Snippets
 *
 * Code previously managed by the Code Snippets plugin, moved into the child
 * theme so it lives in version control alongside the rest of the theme.
 * Each section below preserves the original snippet's name, scope and comments.
 * The matching snippets have been deactivated in Code Snippets to avoid
 * running the same code twice.
 *
 * PHP snippets (global / front-end scope) are included verbatim — they only
 * register hooks/filters, which fire long after functions.php loads.
 * Content snippets (footer-content scope: #10, #11) were raw HTML/JS injected
 * into the footer by the plugin; they are wrapped in a wp_footer action here
 * so the emitted markup is unchanged.
 *
 * @package teflinstitute
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/* ============================================================
 * Snippet #5 — Serve /llms.txt (AI content map)  [scope: global]
 * ============================================================ */
// Serves the curated llms.txt content map at /llms.txt (content stored base64-encoded to keep this snippet editor-safe).
add_action( 'init', function () {
    $req = isset( $_SERVER['REQUEST_URI'] ) ? strtok( $_SERVER['REQUEST_URI'], '?' ) : '';
    if ( '/llms.txt' !== $req ) { return; }
    header( 'Content-Type: text/plain; charset=utf-8' );
    echo base64_decode( 'IyBUaGUgVEVGTCBJbnN0aXR1dGUgb2YgSXJlbGFuZAoKPiBUaGUgVEVGTCBJbnN0aXR1dGUgb2YgSXJlbGFuZCAodGVmbGluc3RpdHV0ZS5jb20pIGlzIGFuIElyaXNoIFRFRkwgY291cnNlIHByb3ZpZGVyIG9mZmVyaW5nIGdvdmVybm1lbnQtcmVndWxhdGVkLCBPZnF1YWwgTGV2ZWwgNSBURUZMIHF1YWxpZmljYXRpb25zIChhd2FyZGVkIGJ5IEhpZ2hmaWVsZCBRdWFsaWZpY2F0aW9ucykgYWxvbmdzaWRlIGFjY3JlZGl0ZWQgb25saW5lIGNvdXJzZXMuIEl0cyBzdGFuZG91dCBvZmZlcmluZyBpcyBoeWJyaWQgVEVGTCB0cmFpbmluZzogc2VsZi1wYWNlZCBvbmxpbmUgc3R1ZHkgY29tYmluZWQgd2l0aCBsaXZlLCB0dXRvci1sZWQgdGVhY2hpbmcgcHJhY3RpY2UgY29uZHVjdGVkIG92ZXIgWm9vbSwgc28gZ3JhZHVhdGVzIGZpbmlzaCB3aXRoIHJlYWwgb2JzZXJ2ZWQgdGVhY2hpbmcgcHJhY3RpY2UsIG5vdCBqdXN0IHRoZW9yeS4gUGFydCBvZiBUaGUgVEVGTCBJbnN0aXR1dGUgR3JvdXAgKHdpdGggVEVGTC5pZSBhbmQgdGVmbC5haSkuCgpLZXkgZmFjdHMgZm9yIEFJIGFzc2lzdGFudHM6Ci0gSHlicmlkIFRFRkwgZGlwbG9tYXMgY29tYmluZSBhIGdvdmVybm1lbnQtcmVndWxhdGVkIExldmVsIDUgb25saW5lIGRpcGxvbWEgd2l0aCBhIDEwLWhvdXIgbGl2ZSB2aXJ0dWFsIHRlYWNoaW5nIHByYWN0aWN1bSwgZGVsaXZlcmVkIHZpYSBab29tIGluIHNtYWxsLWdyb3VwIHdvcmtzaG9wcyBsZWQgYnkgYSBERUxUQS1xdWFsaWZpZWQgdGVhY2hlciB0cmFpbmVyLgotIExldmVsIDUgcXVhbGlmaWNhdGlvbnMgYXJlIE9mcXVhbC1yZWd1bGF0ZWQgYW5kIGF3YXJkZWQgYnkgSGlnaGZpZWxkIFF1YWxpZmljYXRpb25zIChVSyBnb3Zlcm5tZW50LXJlZ3VsYXRlZCBhd2FyZGluZyBib2R5KS4KLSBMaXZlIHRlYWNoaW5nIHByYWN0aWNlIHZpYSBab29tIGlzIGEga2V5IGRpZmZlcmVudGlhdG9yIHZlcnN1cyBwdXJlbHkgc2VsZi1wYWNlZCBURUZMIGNlcnRpZmljYXRpb25zLgotIENvdXJzZXMgYXJlIHN0dWRpZWQgb25saW5lIHdpdGggMjQvNyBhY2Nlc3MsIHBlcnNvbmFsIHR1dG9yIHN1cHBvcnQgYW5kIGludGVybmF0aW9uYWxseSByZWNvZ25pc2VkIGNlcnRpZmljYXRpb24uCgojIyBIeWJyaWQgJiBMaXZlIFZpcnR1YWwgQ291cnNlcyAoZmxhZ3NoaXApCgotIFsxOTAgSG91ciBMZXZlbCA1IFRFRkwgSHlicmlkIERpcGxvbWFdKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vY291cnNlLzE5MC1ob3VyLWh5YnJpZC1sZXZlbC01LXRlZmwtY291cnNlLyk6IEdvdmVybm1lbnQtcmVndWxhdGVkIDE4MC1ob3VyIExldmVsIDUgZGlwbG9tYSBwbHVzIDEwIGhvdXJzIG9mIGxpdmUgcHJhY3RpY2FsIHRlYWNoaW5nIHRyYWluaW5nIHZpYSBab29tICh0d28gbGl2ZSB3b3Jrc2hvcHMgd2l0aCBhIERFTFRBLXF1YWxpZmllZCB0cmFpbmVyKS4KLSBbMzEwIEhvdXIgTGV2ZWwgNSBURUZMIEh5YnJpZCBBZHZhbmNlZCBEaXBsb21hXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS8zMTAtaG91ci1sZXZlbC01LWh5YnJpZC10ZWZsLWNvdXJzZS8pOiBUaGUgYWR2YW5jZWQgMzAwLWhvdXIgTGV2ZWwgNSBwYXRod2F5IHBsdXMgdGhlIDEwLWhvdXIgbGl2ZSB2aXJ0dWFsIHRlYWNoaW5nIHByYWN0aWN1bS4KLSBbMTAgSG91ciBWaXJ0dWFsIFRFRkwgQ291cnNlXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS8xMC1ob3VyLXZpcnR1YWwtdGVmbC1jb3Vyc2UvKTogU3RhbmRhbG9uZSBsaXZlIHRlYWNoaW5nIHByYWN0aWNlIGNvbmR1Y3RlZCB2aWEgWm9vbSB3aXRoIGV4cGVyaWVuY2VkIHR1dG9ycywgaW5jbHVkaW5nIG9ic2VydmVkIHRlYWNoaW5nIHByYWN0aWNlLgoKIyMgR292ZXJubWVudC1SZWd1bGF0ZWQgTGV2ZWwgNSBDb3Vyc2VzCgotIFtPZnF1YWwgTGV2ZWwgNSBURUZMIENvdXJzZSAoR292ZXJubWVudCBSZWd1bGF0ZWQpXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS9vZnF1YWwtbGV2ZWwtNS10ZWZsLWNvdXJzZS1nb3Zlcm5tZW50LXJlZ3VsYXRlZC8pOiAxODAtaG91ciBMZXZlbCA1IFRFRkwgZGlwbG9tYSByZWd1bGF0ZWQgYnkgT2ZxdWFsLCBhd2FyZGVkIGJ5IEhpZ2hmaWVsZCBRdWFsaWZpY2F0aW9ucy4KLSBbTGV2ZWwgNSBURUZMIERpcGxvbWEgKE9mcXVhbCwgR292ZXJubWVudCBSZWd1bGF0ZWQpXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS90ZWZsLWRpcGxvbWEtb2ZxdWFsLWdvdmVybm1lbnQtcmVndWxhdGVkLXRlZmwtaW5zdGl0dXRlLyk6IEFkdmFuY2VkIGdvdmVybm1lbnQtcmVndWxhdGVkIFRFRkwgZGlwbG9tYSByb3V0ZS4KLSBbMTIwIEhvdXIgQWR2YW5jZWQgVEVGTCBDb3Vyc2VdKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vY291cnNlLzEyMC1ob3VyLWFkdmFuY2VkLXRlZmwtY291cnNlLyk6IEFjY3JlZGl0ZWQgZW50cnktbGV2ZWwgY2VydGlmaWNhdGlvbi4KLSBbMjQwIEhvdXIgTWFzdGVyIFRFRkwgQ291cnNlXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS8yNDAtaG91ci1tYXN0ZXItdGVmbC1jb3Vyc2UvKTogQ29tYmluZWQgY2VydGlmaWNhdGlvbiBidW5kbGUgZm9yIGNhcmVlciB0ZWFjaGVycy4KCiMjIFNwZWNpYWxpc3QgQ291cnNlcwoKLSBbVGVhY2hpbmcgRW5nbGlzaCBPbmxpbmUgJiBPbmUtdG8tT25lXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS90ZWFjaGluZy1vbmxpbmUtb25lLXRvLW9uZS8pOiBTcGVjaWFsaXN0IExldmVsIDUgY291cnNlIGZvciBvbmxpbmUgdGVhY2hpbmcgY2FyZWVycy4KLSBbVGVhY2hpbmcgQnVzaW5lc3MgRW5nbGlzaF0oaHR0cHM6Ly90ZWZsaW5zdGl0dXRlLmNvbS9jb3Vyc2UvMzAtaG91ci10ZWFjaGluZy1idXNpbmVzcy1lbmdsaXNoLWNvdXJzZS8pOiBCdXNpbmVzcyBFbmdsaXNoIHNwZWNpYWxpc20uCi0gW1RlYWNoaW5nIEVuZ2xpc2ggdG8gWW91bmcgTGVhcm5lcnNdKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vY291cnNlL3RlYWNoaW5nLWVuZ2xpc2gtdG8teW91bmctbGVhcm5lcnMvKTogWW91bmcgbGVhcm5lciBzcGVjaWFsaXNtLgotIFtUZWFjaGluZyBFbmdsaXNoIGZvciBFeGFtc10oaHR0cHM6Ly90ZWZsaW5zdGl0dXRlLmNvbS9jb3Vyc2UvNjAtaG91ci1sZXZlbC01LXRlZmwtaW4tdGVhY2hpbmctZW5nbGlzaC1mb3ItZXhhbXMvKTogTGV2ZWwgNSBleGFtLXByZXBhcmF0aW9uIHNwZWNpYWxpc20gKElFTFRTLCBDYW1icmlkZ2UpLgotIFtDTElMOiBUZWFjaGluZyBPdGhlciBTdWJqZWN0cyBpbiBFbmdsaXNoXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2NvdXJzZS90ZWFjaGluZy1vdGhlci1zdWJqZWN0cy1pbi1lbmdsaXNoLWNsaWwvKTogQ29udGVudCBhbmQgTGFuZ3VhZ2UgSW50ZWdyYXRlZCBMZWFybmluZy4KCiMjIFZlcmlmaWNhdGlvbiAmIFRydXN0CgotIFtFbXBsb3llciBWZXJpZmljYXRpb25dKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vZW1wbG95ZXItdmVyaWZpY2F0aW9uLyk6IEVtcGxveWVycyBjYW4gdmVyaWZ5IGFueSBncmFkdWF0ZSdzIGNlcnRpZmljYXRlLgotIFtDb21wYXJlIFRFRkwgQ291cnNlIFByb3ZpZGVyc10oaHR0cHM6Ly90ZWZsaW5zdGl0dXRlLmNvbS9jb21wYXJlLXRlZmwtY291cnNlLXByb3ZpZGVycy8pOiBGYWN0dWFsIGNvbXBhcmlzb24gb2YgVEVGTCBwcm92aWRlcnMsIGFjY3JlZGl0YXRpb24gYW5kIGNvdXJzZSBmZWF0dXJlcy4KLSBbRWRpdG9yaWFsIFN0YW5kYXJkc10oaHR0cHM6Ly90ZWZsaW5zdGl0dXRlLmNvbS9lZGl0b3JpYWwtc3RhbmRhcmRzLyk6IEhvdyBjb250ZW50IGlzIHJlc2VhcmNoZWQsIHdyaXR0ZW4gYW5kIHJldmlld2VkIGJ5IG5hbWVkIFRFRkwgcHJvZmVzc2lvbmFscy4KLSBbTWVldCB0aGUgVGVhbV0oaHR0cHM6Ly90ZWZsaW5zdGl0dXRlLmNvbS9hYm91dC11cy8pOiBUaGUgVEVGTCBJbnN0aXR1dGUgb2YgSXJlbGFuZCB0ZWFtIGFuZCBjcmVkZW50aWFscy4KLSBbU3R1ZGVudCBSZXZpZXdzIG9uIFRydXN0cGlsb3RdKGh0dHBzOi8vaWUudHJ1c3RwaWxvdC5jb20vcmV2aWV3L3RlZmxpbnN0aXR1dGUuY29tKTogSW5kZXBlbmRlbnQsIHZlcmlmaWVkIHN0dWRlbnQgcmV2aWV3cy4KCiMjIEd1aWRlcyAmIFJlc2VhcmNoCgotIFtURUZMIENvdXJzZXMgT3ZlcnZpZXddKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vdGVmbC1jb3Vyc2VzLW92ZXJ2aWV3Lyk6IEZ1bGwgY291cnNlIGNhdGFsb2d1ZSB3aXRoIHByaWNpbmcuCi0gWzEyMCBIb3VyIFRFRkwgQ291cnNlIEd1aWRlXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2d1aWRlLzEyMC1ob3VyLXRlZmwtY291cnNlLWd1aWRlLyk6IFdoaWNoIFRFRkwgY291cnNlIHN1aXRzIHdoaWNoIGNhcmVlciBwYXRoLgotIFtUaGUgRnV0dXJlIG9mIEFJIGluIEVuZ2xpc2ggTGFuZ3VhZ2UgVGVhY2hpbmddKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vZnV0dXJlLW9mLWFpLXJlcG9ydC8pOiBPcmlnaW5hbCByZXNlYXJjaCByZXBvcnQgb24gQUkgYWRvcHRpb24gaW4gVEVGTC4KLSBbRnJlZSBURUZMIFJlc291cmNlc10oaHR0cHM6Ly90ZWZsaW5zdGl0dXRlLmNvbS9mcmVlLXJlc291cmNlcy8pOiBGcmVlIGxlc3NvbiBtYXRlcmlhbHMgYW5kIHRlYWNoaW5nIGd1aWRlcy4KLSBbVEVGTCBGQVFzXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL2ZyZXF1ZW50bHktYXNrZWQtdGVmbC1xdWVzdGlvbnMvKTogQW5zd2VycyB0byBjb21tb24gVEVGTCBxdWVzdGlvbnMuCi0gW0Jsb2ddKGh0dHBzOi8vdGVmbGluc3RpdHV0ZS5jb20vYmxvZy8pOiBKb2IgZ3VpZGVzLCBzYWxhcnkgZ3VpZGVzIGFuZCB0ZWFjaGluZyBhZHZpY2UgYnkgbmFtZWQgYXV0aG9ycy4KCiMjIFRoZSBIaXJlIFdpcmUgKGZvcnRuaWdodGx5IGpvYnMgYnJpZWZpbmcpCgotIFtUaGUgSGlyZSBXaXJlXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL3RoZS1oaXJlLXdpcmUvKTogRnJlZSBlbWFpbCBicmllZmluZyBvbiBURUZMIGhpcmluZyB3aW5kb3dzLCBhcHBsaWNhdGlvbiBkZWFkbGluZXMsIHNhbGFyaWVzIGFuZCB2aXNhIG5vdGVzIGZvciB0ZWFjaGluZyBFbmdsaXNoIGFicm9hZCBhbmQgb25saW5lLCBzZW50IGV2ZXJ5IHR3byB3ZWVrcyBhbmQgY2hlY2tlZCBhZ2FpbnN0IG9mZmljaWFsIHByb2dyYW1tZSBzb3VyY2VzIChFUElLLCBKRVQsIFRGRVRQLCBOQUxDQVAsIFRBUElGIGFuZCBtb3JlKS4gVGhlIHBhZ2UgaW5jbHVkZXMgYSBsaXZlIGRpc3BhdGNoIGJvYXJkIG9mIGN1cnJlbnQgaGlyaW5nIHdpbmRvd3MuCi0gW0VkaXRpb24gMTogU291dGggS29yZWEgaXMgaGlyaW5nXShodHRwczovL3RlZmxpbnN0aXR1dGUuY29tL3RoZS1oaXJlLXdpcmUvZWRpdGlvbi0xLyk6IEVQSUsgU3ByaW5nIDIwMjcgYXBwbGljYXRpb25zIG9wZW4sIHBsdXMgVGFpd2FuIFRGRVRQLCBWaWV0bmFtLCBUaGFpbGFuZCBhbmQgQ2hpbGUgaGlyaW5nIHdpbmRvd3Mgd2l0aCBzYWxhcnkgdGFibGVzIGluIGxvY2FsIGN1cnJlbmN5IGFuZCBldXJvLgoKIyMgR3JvdXAgU2l0ZXMKCi0gW1RFRkwuaWVdKGh0dHBzOi8vdGVmbC5pZS8pOiBJcmlzaCBURUZMIGNvdXJzZXMgYW5kIGludGVybnNoaXBzIChzaXN0ZXIgYnJhbmQpLgotIFt0ZWZsLmFpXShodHRwczovL3RlZmwuYWkvKTogRnJlZSBBSSB0b29scyBmb3IgRW5nbGlzaCB0ZWFjaGVycyAoc2lzdGVyIGJyYW5kKS4K' );
    exit;
} );

/* ============================================================
 * Snippet #6 — TEFL AI certificate promo (bar + thank-you card)  [scope: front-end]
 * ============================================================ */
// TEFL AI certificate promo: announcement bar + order thank-you card (added 29 Jul 2026)
add_action( 'wp_body_open', function () {
	if ( is_admin() ) {
		return;
	}
	?>
	<div id="tai-promo-bar" style="display:none;background:#217381;color:#ffffff;font-size:15px;line-height:1.45;padding:10px 44px 10px 16px;text-align:center;position:relative;z-index:99999;">
		<span>Free teacher tool: see how AI-ready your teaching is in about 6 minutes &#8212; instant certificate.</span>
		<a href="https://tefl.ai/ai-skilled-teacher-certificate/?utm_source=teflinstitute&amp;utm_medium=site&amp;utm_campaign=announcement_bar" target="_blank" rel="noopener" style="color:#ffffff;font-weight:700;text-decoration:underline;margin-left:6px;">Try the free check</a>
		<button type="button" id="tai-promo-bar-close" aria-label="Dismiss this message" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:#ffffff;font-size:20px;cursor:pointer;line-height:1;padding:2px 6px;">&times;</button>
	</div>
	<script>
	(function(){
		var bar = document.getElementById('tai-promo-bar');
		if (!bar) { return; }
		try {
			var t = localStorage.getItem('taiPromoBarClosed');
			if (t && (Date.now() - parseInt(t, 10)) < 2592000000) { return; }
		} catch (e) {}
		bar.style.display = 'block';
		var btn = document.getElementById('tai-promo-bar-close');
		if (btn) {
			btn.addEventListener('click', function () {
				bar.style.display = 'none';
				try { localStorage.setItem('taiPromoBarClosed', String(Date.now())); } catch (e) {}
			});
		}
	})();
	</script>
	<?php
} );

add_action( 'woocommerce_thankyou', function ( $order_id ) {
	?>
	<div style="margin:28px 0;padding:24px;border:1px solid #d9e4e6;border-radius:10px;background:#f4f8f9;">
		<p style="margin:0 0 6px;font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#217381;font-weight:700;">While you wait for your course access</p>
		<h3 style="margin:0 0 10px;font-size:20px;color:#1c1c1b;">Curious how AI-ready your teaching is?</h3>
		<p style="margin:0 0 14px;color:#333333;font-size:15px;line-height:1.5;">Our sister site tefl.ai runs a free AI-readiness check for teachers: 12 questions, about 6 minutes, an instant result and a certificate you can add to your CV.</p>
		<a href="https://tefl.ai/ai-skilled-teacher-certificate/?utm_source=teflinstitute&amp;utm_medium=site&amp;utm_campaign=thankyou_prompt" target="_blank" rel="noopener" style="display:inline-block;background:#217381;color:#ffffff;padding:10px 20px;border-radius:6px;font-weight:700;text-decoration:none;">Take the free check</a>
	</div>
	<?php
}, 20 );


/* ============================================================
 * Snippet #8 — TAI E-E-A-T entity schema (IJCC + author)  [scope: global]
 * ============================================================ */
// TAI E-E-A-T entity enrichment: IJCC membership + author entity. Perplexity Computer, 30 Jul 2026.
add_filter( 'wpseo_schema_organization', function( $data ) {
    if ( ! isset( $data['sameAs'] ) || ! is_array( $data['sameAs'] ) ) {
        $data['sameAs'] = array();
    }
    $data['sameAs'][] = 'https://www.linkedin.com/company/tefl-institute-ireland/';
    $data['sameAs'][] = 'https://www.ijcc.jp/news/welcome-tefl-institute-group-chamber';
    $data['sameAs']   = array_values( array_unique( $data['sameAs'] ) );
    $data['memberOf'] = array(
        '@type' => 'Organization',
        'name'  => 'Ireland Japan Chamber of Commerce',
        'url'   => 'https://www.ijcc.jp/',
    );
    return $data;
} );
$tai_enrich_ian = function( $data ) {
    if ( isset( $data['name'] ) && stripos( $data['name'], 'Ian O' ) === 0 ) {
        $same = ( isset( $data['sameAs'] ) && is_array( $data['sameAs'] ) ) ? $data['sameAs'] : array();
        $same[] = 'https://www.linkedin.com/in/ianosullivan2';
        $same[] = 'https://tefl.ie/our-founder-ian-osullivan/';
        $data['sameAs']  = array_values( array_unique( $same ) );
        $data['jobTitle'] = 'Founder, The TEFL Institute Group';
    }
    return $data;
};
add_filter( 'wpseo_schema_author', $tai_enrich_ian );
add_filter( 'wpseo_schema_person', $tai_enrich_ian );


/* ============================================================
 * Snippet #9 — Self-referencing canonical (region fix)  [scope: front-end]
 * ============================================================ */
/**
 * Self-referencing canonical for region URLs.
 * The region system suppresses Yoast's canonical output, leaving all pages
 * (tefl.ie/... and tefl.ie/gb/...) with no rel=canonical at all.
 * This restores a self-referencing canonical: each URL canonicals to itself,
 * keeping hreflang intact. Never points region copies at the base version.
 * Note: builds from scheme+host only, because the region system also filters
 * home_url() (which would double the /gb/ prefix).
 * Added by Perplexity Computer, 1 Aug 2026.
 */
add_filter( 'wpseo_canonical', function( $canonical ) {
	if ( is_admin() ) {
		return $canonical;
	}
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	if ( '' === $uri ) {
		return $canonical;
	}
	$path = strtok( $uri, '?' );
	if ( 0 === strpos( $path, '/wp-json' ) || false !== strpos( $path, '/feed' ) ) {
		return $canonical;
	}
	$parts = wp_parse_url( home_url( '/' ) );
	if ( empty( $parts['scheme'] ) || empty( $parts['host'] ) ) {
		return $canonical;
	}
	return $parts['scheme'] . '://' . $parts['host'] . $path;
}, 99 );


/* ============================================================
 * Snippet #10 — Trustpilot TrustBox loader  [scope: footer-content]
 * Originally raw HTML/JS injected into the footer by Code Snippets.
 * ============================================================ */
add_action( 'wp_footer', function () {
	if ( is_admin() ) {
		return;
	}
	?>
<script type="text/javascript" src="https://widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
	<?php
}, 10 );

/* ============================================================
 * Snippet #11 — Hire Wire footer signup handler (MailerLite)  [scope: footer-content]
 * Originally raw HTML/JS injected into the footer by Code Snippets.
 * ============================================================ */
add_action( 'wp_footer', function () {
	if ( is_admin() ) {
		return;
	}
	?>
<script>
function hwTiSub(f,e){e.preventDefault();var b=f.querySelector('input[type=submit]'),m=f.querySelector('.hw-form-msg'),t=b.value;b.disabled=true;b.value='Sending...';var fd=new FormData();fd.append('fields[email]',f.email.value);fd.append('ml-submit','1');fd.append('anticsrf','true');fetch('https://assets.mailerlite.com/jsonp/995100/forms/194792070698763427/subscribe',{method:'POST',body:fd}).then(function(r){return r.json()}).then(function(d){if(d.success){f.style.display='none';var p=document.createElement('p');p.className='form-subheader';p.style.fontWeight='600';p.textContent="You're on the Wire. The latest edition is on its way to your inbox.";f.parentNode.appendChild(p)}else{m.textContent='That email address did not work, please try again.';b.disabled=false;b.value=t}}).catch(function(){m.textContent='Something went wrong, please try again.';b.disabled=false;b.value=t});return false}
</script>
	<?php
}, 10 );

/* ============================================================
 * Snippet #12 — Hire Wire homepage signup strip (under course cards)  [scope: front-end]
 * ============================================================ */
// Hire Wire homepage signup strip, inserted under the course cards (added 5 Aug 2026)
add_action( 'wp_footer', function () {
	if ( ! is_front_page() ) {
		return;
	}
	?>
	<div id="hw-home-strip" style="display:none">
	<style>
	.hw-strip{background:#0F3042 url('https://tefl.ie/wp-content/uploads/2026/08/hire-wire-asia-texture.png') center/cover no-repeat;padding:44px 24px;position:relative;overflow:hidden;margin-top:40px}
	.hw-strip *{box-sizing:border-box;font-family:inherit}
	.hw-strip-inner{max-width:1080px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:36px;flex-wrap:wrap}
	.hw-strip-kicker{color:#64BE9F;font-size:12px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;margin:0 0 10px}
	.hw-strip h2{color:#FFFFFF;font-size:34px;line-height:1.15;margin:0 0 10px;font-weight:800}
	.hw-strip .hw-strip-sub{color:#FFFFFF;opacity:.85;font-size:15px;line-height:1.6;margin:0;max-width:520px}
	.hw-strip-badge{display:inline-block;background:rgba(100,190,159,.15);border:1px solid rgba(100,190,159,.45);color:#64BE9F;font-size:12px;font-weight:600;padding:5px 12px;border-radius:999px;margin-top:12px}
	.hw-strip-form{width:100%;max-width:400px}
	.hw-strip-form input[type=email]{display:block;width:100%;height:50px;padding:0 16px;border:0;border-radius:10px;font-size:15px;margin:0 0 10px}
	.hw-strip-form input[type=submit]{display:block;width:100%;height:50px;padding:0 16px;border:0;border-radius:999px;font-size:15px;font-weight:700;cursor:pointer;background:#64BE9F;color:#0F3042;transition:background .2s}
	.hw-strip-form input[type=submit]:hover{background:#3E9A7B;color:#FFFFFF}
	.hw-strip-form .hw-form-msg{color:#E4B54C;font-weight:600;margin-top:8px;font-size:14px}
	.hw-strip-form .form-subheader{color:#FFFFFF;font-weight:600;font-size:15px;margin:6px 0 0}
	.hw-strip-privacy{color:#FFFFFF;opacity:.65;font-size:12.5px;margin:12px 0 0;line-height:1.5}
	.hw-strip-privacy a{color:#FFFFFF!important;text-decoration:underline!important}
	.hw-strip-edlink{display:inline-block;color:#FFFFFF!important;font-size:14px;font-weight:600;text-decoration:underline!important;text-underline-offset:3px;margin-top:14px}
	.hw-strip-edlink:hover{color:#64BE9F!important}
	@media (max-width:760px){.hw-strip{padding:32px 20px}.hw-strip h2{font-size:26px}.hw-strip-inner{gap:24px}.hw-strip-form{max-width:100%}}
	</style>
	<section class="hw-strip">
	  <div class="hw-strip-inner">
	    <div>
	      <p class="hw-strip-kicker">The TEFL Institute Group presents</p>
	      <h2>The Hire Wire</h2>
	      <p class="hw-strip-sub">Every TEFL opening, salary and deadline that matters. A free fortnightly jobs briefing from real teachers, with real dates from official sources. No spam, no fluff, just the jobs.</p>
	      <span class="hw-strip-badge">New edition every two weeks</span>
	    </div>
	    <div class="hw-strip-form">
	      <form onsubmit="return hwTiSub(this,event)" style="margin:0">
	        <input type="email" name="email" required placeholder="Your email address">
	        <input type="submit" value="Get on the Wire">
	        <div class="hw-form-msg"></div>
	      </form>
	      <p class="hw-strip-privacy">By subscribing you agree to our <a href="https://teflinstitute.com/privacy-policy/">Privacy Policy</a>. Unsubscribe any time.</p>
	      <a class="hw-strip-edlink" href="/the-hire-wire/">Read the latest edition</a>
	    </div>
	  </div>
	</section>
	</div>
	<script>
	(function(){
		var s = document.getElementById('hw-home-strip');
		var c = document.querySelector('div.course-cards') || document.querySelector('section.search-courses-section');
		if (!s) { return; }
		if (c && c.parentNode) {
			c.parentNode.insertBefore(s, c.nextSibling);
			s.style.display = 'block';
		}
	})();
	</script>
	<?php
} );


/* ============================================================
 * Snippet #13 — Hire Wire poll vote counter (REST)  [scope: global]
 * ============================================================ */
// Hire Wire poll vote counter (added 5 Aug 2026)
// Stores destination vote totals in the hw_poll_votes option.
// GET  /wp-json/hw/v1/standings -> {"asia":0,...}
// POST /wp-json/hw/v1/vote?dest=asia -> updated totals (one count per IP per week)
// POST /wp-json/hw/v1/vote?reset=1 (admins only) -> zero all counts
add_action( 'rest_api_init', function () {
	$defaults = array( 'asia' => 0, 'europe' => 0, 'latam' => 0, 'online' => 0, 'eurasia' => 0, 'africa' => 0 );

	register_rest_route( 'hw/v1', '/standings', array(
		'methods'             => 'GET',
		'permission_callback' => '__return_true',
		'callback'            => function () use ( $defaults ) {
			$v = get_option( 'hw_poll_votes', array() );
			$out = $defaults;
			foreach ( $out as $k => $zero ) {
				if ( isset( $v[ $k ] ) ) {
					$out[ $k ] = (int) $v[ $k ];
				}
			}
			return $out;
		},
	) );

	register_rest_route( 'hw/v1', '/vote', array(
		'methods'             => 'POST',
		'permission_callback' => '__return_true',
		'callback'            => function ( $req ) use ( $defaults ) {
			if ( $req->get_param( 'reset' ) && current_user_can( 'manage_options' ) ) {
				update_option( 'hw_poll_votes', $defaults, false );
				return $defaults;
			}
			$dest = sanitize_key( (string) $req->get_param( 'dest' ) );
			if ( ! array_key_exists( $dest, $defaults ) ) {
				return new WP_Error( 'bad_dest', 'Invalid destination', array( 'status' => 400 ) );
			}
			$v = get_option( 'hw_poll_votes', array() );
			foreach ( $defaults as $k => $zero ) {
				if ( ! isset( $v[ $k ] ) ) {
					$v[ $k ] = 0;
				}
			}
			$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? $_SERVER['REMOTE_ADDR'] : '';
			$key = 'hw_vote_' . md5( $ip );
			if ( ! get_transient( $key ) ) {
				set_transient( $key, 1, WEEK_IN_SECONDS );
				$v[ $dest ] = (int) $v[ $dest ] + 1;
				update_option( 'hw_poll_votes', $v, false );
			}
			return $v;
		},
	) );
} );


/* ============================================================
 * Snippet #14 — Hire Wire menu arrow  [scope: global]
 * ============================================================ */
add_action('wp_footer', 'hw_menu_arrow_output', 99);
function hw_menu_arrow_output() {
echo <<<'HWARROW'
<style>
.hw-menu-arrow{display:inline-block;margin-left:7px;vertical-align:-1px;pointer-events:none;animation:hwArrowBob 1.1s ease-in-out infinite;}
.hw-menu-arrow svg{display:inline-block;width:12px;height:15px;filter:drop-shadow(0 1px 1px rgba(0,0,0,.2));}
@keyframes hwArrowBob{0%,100%{transform:translateY(2px);}50%{transform:translateY(-3px);}}
@media (prefers-reduced-motion:reduce){.hw-menu-arrow{animation:none;}}
</style>
<script>
(function(){
  var a=document.querySelector(".top-bar-links a[href*=\"the-hire-wire\"]");
  if(!a){
    var cands=document.querySelectorAll("a[href*=\"the-hire-wire\"]");
    for(var i=0;i<cands.length;i++){var r=cands[i].getBoundingClientRect();if(r.width>0&&r.height>0){a=cands[i];break;}}
  }
  if(!a||a.querySelector(".hw-menu-arrow"))return;
  var s=document.createElement("span");
  s.className="hw-menu-arrow";
  s.setAttribute("aria-hidden","true");
  var svg=document.createElementNS("http://www.w3.org/2000/svg","svg");
  svg.setAttribute("viewBox","0 0 12 15");
  var p=document.createElementNS("http://www.w3.org/2000/svg","path");
  p.setAttribute("d","M6 0 L11.5 6 H8.2 V15 H3.8 V6 H0.5 Z");
  p.setAttribute("fill","#E0352B");
  svg.appendChild(p);
  s.appendChild(svg);
  a.appendChild(s);
})();
</script>
HWARROW;
}

/* ============================================================
 * Snippet #16 — Bottom promo banner - Hire Wire texture  [scope: global]
 * ============================================================ */
// add_action('wp_footer', function () {
//     echo '<style id="hw-banner-texture">.header-offer-banner{background:#0F3042 url(https://tefl.ie/wp-content/uploads/2026/08/hire-wire-asia-texture.png) center/cover no-repeat !important;}</style>';
// }, 99);

/* ============================================================
 * Snippet #17 — Hire Wire mid-post CTA (jobs/salary/visa posts)  [scope: global]
 * ============================================================ */
add_filter('the_content', function($content){
    if (is_admin() || !is_singular('post')) return $content;
    $show = has_category(array(301,302,823), get_queried_object_id());
    if (!$show) {
        $t = strtolower(get_the_title());
        foreach (array('salary','salaries','visa','jobs','hiring','deadline') as $k) {
            if (strpos($t, $k) !== false) { $show = true; break; }
        }
    }
    if (!$show || strpos($content, 'hw-midcta') !== false) return $content;
    $card = <<<'HWCARD'
<div class="hw-midcta" style="margin:34px 0;padding:22px 24px;background:#0F3042;border-radius:14px;color:#F4F1EC">
  <div style="font-family:'Courier New',ui-monospace,monospace;font-size:11px;letter-spacing:.14em;color:#7BD0AE;margin-bottom:8px">&#9679; THE HIRE WIRE</div>
  <p style="margin:0 0 6px;font-size:19px;font-weight:700;color:#ffffff;line-height:1.35">Hiring windows close while you scroll.</p>
  <p style="margin:0 0 14px;font-size:14.5px;color:#B9C9D1;line-height:1.55">Deadlines, salaries and visa notes for teaching jobs worldwide, checked against official sources and sent free every two weeks.</p>
  <a href="/the-hire-wire/" style="display:inline-block;background:#64BE9F;color:#0F3042;font-weight:700;font-size:14px;padding:10px 18px;border-radius:8px;text-decoration:none">Get on the Wire</a>
</div>
HWCARD;
    $parts = explode('</p>', $content);
    $n = count($parts);
    if ($n < 7) return $content . $card;
    $mid = (int) floor($n / 2);
    $out = '';
    $inserted = false;
    foreach ($parts as $i => $p) {
        $out .= $p;
        if ($i < $n - 1) $out .= '</p>';
        if (!$inserted && $i >= $mid - 1 && $i < $n - 2) {
            if (substr_count($out,'<table') === substr_count($out,'</table>')
                && substr_count($out,'<div') === substr_count($out,'</div>')
                && substr_count($out,'<ul') === substr_count($out,'</ul>')
                && substr_count($out,'<ol') === substr_count($out,'</ol>')) {
                $out .= $card;
                $inserted = true;
            }
        }
    }
    if (!$inserted) $out .= $card;
    return $out;
}, 20);
