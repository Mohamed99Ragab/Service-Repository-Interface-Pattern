app/
    core
        ├── Contracts/
        │    ├── IPostSerivice.php
        │    └── IAuthService.php
        ├── Repositories/
        │       Interfaces
        │       ├── IPostRepository.php
        │       └── IUserRepository.php
        │        BaseRepository.php
        │        PostRepository.php
        │        UserRepository.php
        ├── Services/
        │        └── Post 
        │            └──   PostService.php
        │            └──   PostMobileService.php
        │            └──   PostWebService.php
        # App Architecture — service/repository + platform-aware services

        This repository demonstrates an opinionated application architecture built on a layered service + repository pattern with platform-aware implementations (web vs mobile) and provider-based dependency wiring.

        The goal is to keep business logic in services, persistence in repositories, and controller code thin. The project separates contracts (interfaces) from concrete implementations so different implementations can be swapped easily (for testing, platform differences, or future refactors).

        ## High-level contract
        - Inputs: HTTP requests (web or API) routed to controllers.
        - Core outputs: JSON responses (API) or rendered views (Web) via controllers using services.
        - Error modes: service/repository exceptions propagate up and are handled by controllers or middleware.

        ## Folder layout

        Top-level folders relevant to the pattern:

        - `app/core/Contracts/` — interface definitions for services used by controllers, e.g. `IPostService.php`, `IAuthService.php`.
        - `app/core/Repositories/` — repository implementations and a `BaseRepository.php` base class. Also contains `Interfaces/` for repository contracts (`IPostRepository.php`, `IUserRepository.php`).
        - `app/core/Services/` — application services (business logic). Each service may have multiple platform-specific variants:
            - `Post/` contains `PostService.php`, `PostWebService.php`, `PostMobileService.php`.
            - `Auth/` contains `AuthService.php`, `AuthWebService.php`, `AuthMobileService.php`.
        - `app/Http/Controllers/` — controllers split by `Web/` and `API/V1/` (keeps web and API entry points separate and small).
        - `app/Http/Middleware/DetectPlatform.php` — middleware used to detect the request platform (web or mobile) and influence service resolution.
        - `app/Models/` — Eloquent-style models like `User.php` and `Post.php`.
        - `app/Providers/` — service providers that bind interfaces to implementations, e.g. `RepositoryProvider.php` and `AppServiceProvider.php`.

        ## Core ideas and patterns

        1. Dependency inversion: controllers depend on small service interfaces (contracts) rather than concrete classes. Contracts live in `app/core/Contracts`.

        2. Service vs Repository separation:
             - Repositories encapsulate persistence details (database queries, ORM access). They implement repository interfaces in `app/core/Repositories/Interfaces`.
             - Services coordinate repositories and implement higher-level business rules. Services expose interfaces in `app/core/Contracts` and concrete implementations in `app/core/Services`.

        3. Platform-aware implementations:
             - For some services there are multiple concrete implementations for different platforms (Web vs Mobile). Those live next to the general `*Service.php` file, using names like `*WebService.php` and `*MobileService.php`.
             - `DetectPlatform` middleware sets context (often a simple request attribute or container binding) so the provider can resolve the correct implementation at runtime.

        4. Provider-based binding:
             - `app/Providers/RepositoryProvider.php` binds repository interfaces to repository classes.
             - `app/Providers/AppServiceProvider.php` binds service contracts to platform-aware concrete classes, using the platform detection result.

        5. Thin controllers:
             - Controllers receive the appropriate service via constructor injection, call a single service method for the use case, and return the result as a view or JSON response.

        ## How platform detection works (concept)

        - A single middleware `DetectPlatform` inspects headers, user-agent, or a custom request parameter to decide whether the request is from 'web' or 'mobile'.
        - The provider that binds service interfaces checks this platform and resolves the corresponding implementation (e.g., `PostWebService` or `PostMobileService`).

        Example (conceptual):

        - Middleware sets `$request->attributes->set('platform', 'mobile')`.
        - Service provider reads `request('platform')` (or resolves middleware-set value) and then:
            - binds `IPostService` => `PostMobileService` when platform is mobile
            - binds `IPostService` => `PostWebService` when platform is web

        This keeps controller signatures unchanged while altering the behavior behind the interface based on runtime context.

        ## Guidelines for adding features

        - New entity (e.g., Comment):
            1. Add model `app/Models/Comment.php`.
            2. Create repository contract `app/core/Repositories/Interfaces/ICommentRepository.php` and implementation `app/core/Repositories/CommentRepository.php`.
            3. Add service contract `app/core/Contracts/ICommentService.php` and service implementations `app/core/Services/Comment/CommentService.php` plus optional `CommentWebService.php`, `CommentMobileService.php` if platform-specific behavior is needed.
            4. Bind repository and service interfaces in providers (`RepositoryProvider` and `AppServiceProvider`).
            5. Add controllers in `app/Http/Controllers/Web` and/or `app/Http/Controllers/API/V1` that accept the `ICommentService` via constructor injection.

        ## Tests and maintainability

        - Because controllers depend on interfaces, you can easily mock services or repositories in tests.
        - Keep service methods focused and small. Each service should represent a narrowly-scoped use-case.

        ## Example flow (Post creation)

        1. Client (mobile or web) makes POST /posts request.
        2. `DetectPlatform` middleware sets platform.
        3. Router resolves controller ; controller receives `IPostService` (bound to platform-specific implementation).
        4. Controller calls `$postService->create($request->validated())`.
        5. `PostService` coordinates validation/transformations and uses `PostRepository` to persist data.

        ## Notes and trade-offs

        - Pros:
            - Clear separation of responsibilities.
            - Easy to swap implementations for testing or platform-specific behavior.
            - Small, testable units.
        - Cons:
            - More files and indirection than a simple controller+model approach.
            - Overkill for tiny apps; best when multiple platforms, significant business logic, or complex persistence exist.

        ## Where to look in the codebase

        - Service contracts: `app/core/Contracts`
        - Service implementations: `app/core/Services`
        - Repositories and repository interfaces: `app/core/Repositories` and `app/core/Repositories/Interfaces`
        - Controllers: `app/Http/Controllers/Web` and `app/Http/Controllers/API/V1`
        - Platform detection: `app/Http/Middleware/DetectPlatform.php`
        - Providers (bindings): `app/Providers/AppServiceProvider.php`, `app/Providers/RepositoryProvider.php`

        ## Next steps / suggestions

        - Add simple unit tests for one service and one repository.
        - Add documentation for the platform-detection rules (which headers/params are used).
        - Consider using a configuration value or a dedicated PlatformResolver class rather than relying on middleware-set request attributes for easier testing.

        ---

        If you'd like, I can also:
        - add a short code example showing how `AppServiceProvider` selects the concrete service implementation based on platform, or
        - create a small unit test template showing how to mock `IPostRepository` when testing `PostService`.
