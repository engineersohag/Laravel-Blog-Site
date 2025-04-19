<style>
    .rounded {
        border-radius: 0.75rem !important;
    }
    .shadow-sm {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
</style>
<div class="container mt-2">

    <!-- Add Comment Box -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title">Add a new comment</h5>
            <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="">
                <div class="mb-3">
                    <textarea name="comment" class="form-control" rows="4" placeholder="Type Your Comment"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary float-end">Post Comment</button>
            </form>
        </div>
    </div>


    <!-- Comments List -->
    <h5 class="mb-3">Comments</h5>
    @foreach ($blog->comments as $comment)
        <div class="d-flex mb-4 shadow-sm p-3 rounded">
            <img src="{{ asset('img/user.png') }}" style="width: 50px; height: 50px;" class="rounded-circle me-3" alt="User Image">
            <div class="flex-grow-1">
                <div class="bg-light rounded p-3 shadow-sm">
                    <strong>{{ $comment->user->name }}</strong> <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    <p class="mb-1">{{ $comment->comment }}</p>
                </div>

                <!-- Reply Form -->
                <form action="{{ route('comments.store', $blog->id) }}" method="POST" class="mt-2 ms-5">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="mb-2">
                        <textarea name="comment" class="form-control" rows="2" placeholder="Reply to this comment..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Reply</button>
                </form>

                <!-- Replies -->
                @foreach ($comment->replies as $reply)
                    <div class="d-flex mt-3 ms-5">
                        <img src="{{ asset('img/user.png') }}" style="width: 40px; height: 40px;" class="rounded-circle me-2" alt="User Image">
                        <div class="bg-secondary text-white rounded p-3">
                            <strong>{{ $reply->user->name }}</strong> <small class="text-light">{{ $reply->created_at->diffForHumans() }}</small>
                            <p class="mb-0">{{ $reply->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

</div>