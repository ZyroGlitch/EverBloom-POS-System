import { Head } from '@inertiajs/react'
import React from 'react'
import logo from '../../../public/assets/images/logo.png'

export default function MetaTagsLayout() {
    return (
        <>
            <Head>
                <title>Tungal's Flower Shop</title>
                <meta head-key="description" name="description" content="This is the default description" />
                <link rel="icon" type="image/svg+xml" href={logo} />
            </Head>
        </>
    )
}
