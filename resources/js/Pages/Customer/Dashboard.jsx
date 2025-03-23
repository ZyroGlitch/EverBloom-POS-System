import React from 'react'

export default function Dashboard() {
    return (
        <div className="d-flex vh-100 bg-light">
            {/* Sidebar (Fixed, Non-Scrollable) */}
            <div className="bg-success text-light sidebar" style={{ width: '20%', height: '100vh', position: 'fixed' }}>
                <h1>SIDEBAR</h1>
            </div>

            {/* Content Area (Scrollable) */}
            <div className="bg-light content">
                <nav className="d-flex justify-content-between align-items-center bg-info text-light px-3 py-1 sticky-top">
                    <div className="d-flex align-items-center gap-3">
                        <button className="btn btn-secondary humburger-hidden" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"><i class="bi bi-list fs-6"></i></button>
                        <h1>TITLE</h1>
                    </div>
                    <div className="d-flex gap-3">
                        <button className="btn btn-primary">L</button>
                        <button className="btn btn-primary">L</button>
                        <button className="btn btn-primary">P</button>
                    </div>
                </nav>

                <section>
                    <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae deserunt sit laboriosam commodi soluta explicabo sed saepe facere quam, consequatur architecto quibusdam, quo mollitia modi cum quod at tenetur nobis!</h1>

                    <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae deserunt sit laboriosam commodi soluta explicabo sed saepe facere quam, consequatur architecto quibusdam, quo mollitia modi cum quod at tenetur nobis!</h1>

                    <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae deserunt sit laboriosam commodi soluta explicabo sed saepe facere quam, consequatur architecto quibusdam, quo mollitia modi cum quod at tenetur nobis!</h1>
                </section>
            </div>


            {/* Offcanvas */}
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div>
                        Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
                    </div>
                    <div class="dropdown mt-3">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Dropdown button
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    )
}
