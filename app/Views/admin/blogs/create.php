<div class="max-w-4xl mx-auto space-y-6" x-data="blogCreate()">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Write Beauty Journal Post</h1>
        <a href="<?= BASE_URL ?>/admin/blogs" class="text-xs text-zinc-400 hover:underline">&larr; Back to Blogs</a>
    </div>

    <form action="<?= BASE_URL ?>/admin/blogs/store" method="POST" enctype="multipart/form-data" class="bg-zinc-950 p-8 rounded-2xl border border-zinc-800 space-y-6">
        <?= \App\Core\CSRF::field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Post Title *</label>
                <input type="text" name="title" x-model="title" @input="updateSlug()" required class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-rose-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">URL Slug Preview</label>
                <input type="text" readonly :value="slug" class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-zinc-500 focus:outline-none">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Category</label>
                <select name="category_id" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                    <option value="">-- Choose Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Status</label>
                <select name="status" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>

        <!-- CKEditor 5 Editor Container -->
        <div>
            <label class="block text-xs font-semibold text-zinc-400 mb-2">Content Article *</label>
            <div class="text-black">
                <textarea name="content" id="editor" rows="12"></textarea>
            </div>
        </div>

        <!-- SEO Metadata -->
        <div class="space-y-4 pt-4 border-t border-zinc-850">
            <h4 class="font-serif text-sm font-bold text-white uppercase tracking-wider">SEO Fields (Search Engine Optimization)</h4>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Meta Title</label>
                <input type="text" name="meta_title" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white">
            </div>
            <div>
                <label class="block text-xs font-semibold text-zinc-400 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white"></textarea>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-zinc-400 mb-1">Featured Cover Image</label>
            <input type="file" name="featured_image" class="text-xs text-zinc-400 block">
        </div>

        <button type="submit" class="w-full py-4 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm shadow-xl shadow-rose-900/40 transition">
            Publish Article
        </button>
    </form>
</div>

<!-- Initialize CKEditor & Adapter -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '<?= BASE_URL ?>/admin/blogs/upload-image'
                }
            })
            .catch(error => {
                console.error(error);
            });
    });

    function blogCreate() {
        return {
            title: '',
            slug: '',
            updateSlug() {
                this.slug = this.title
                    .toLowerCase()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/(^-|-$)/g, '');
            }
        }
    }
</script>

<style>
.ck-editor__editable_inline {
    min-height: 300px;
}
</style>
